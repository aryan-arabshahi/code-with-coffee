<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Exceptions\InvalidModule;
use App\Http\Response;
use App\Traits\Logger;
use Exception;
use Image;
use Intervention\Image\Image as ImageSource;
use Storage;
use Validator;

class StorageController extends Controller
{
    use Logger;

    public function getImage(
        $module,
        $id,
        $name=null,
        $width = null,
        $height = null
    )
    {
        $response = new Response();

        try {

            $validator = Validator::make([
                'module' => $module,
                'width' => $width,
                'height' => $height,
            ], [
                'module' => 'in:'.implode(config('modules.imageable')),
                'width' => 'nullable|integer|min:100|max:800',
                'height' => 'nullable|integer|min:100|max:800',
            ]);

            if ($validator->fails()) { return $response->failed(404); }

            // Validating the module argument
            $service = $this->getServiceByModule($module);

            $source = $service->get($id);

            if (!$source->image OR !Storage::exists($source->image)) {
                throw new DataNotFound;
            }

            $image = Image::make(Storage::path($source->image));

            $this->resizeImage($image, $width, $height);

            return $image->response();

        } catch (DataNotFound | InvalidModule $e) {

            $this->debug('Could not get the specified image', [
                'module' => $module,
                'id' => $id,
                'reason' => 'data_not_found',
            ]);
            return $response->failed(404);

        } catch (Exception $e) {

            $this->error('Could not get the specified image', [
                'module' => $module,
                'id' => $id,
                'reason' => $e->getMessage(),
            ]);
            return $response->failed(500, __('internal_server_error'));

        }
    }

    /**
     * Create an instance of the proper service based on the module
     * 
     * @param string $module
     * 
     * @return mixed
     * 
     * @throws InvalidModule
     */
    private function getServiceByModule($module): mixed
    {
        if (!in_array($module, config('modules.imageable'))) {
            throw new InvalidModule;
        }
        return app(config("modules.$module.service"));
    }

    /**
     * Resize the image with the aspect ratio
     * 
     * @param Intervention\Image\Image $image
     * @param null|int $width = null
     * @param null|int $height = null
     * 
     * @return Intervention\Image\Image
     */
    private function resizeImage(ImageSource $image, null|int $width = null, null|int $height = null): ImageSource
    {
        if ($width AND $height) {
            $image->fit($width, $height);
        } else if ($width OR $height) {
            $image->fit($width, $height, function($constraint) {
                $constraint->upsize();
            });
        }
        return $image;
    }

}
