<?php

namespace App\Http\Controllers;

use App\Exceptions\DataNotFound;
use App\Exceptions\InvalidModule;
use App\Http\Response;
use App\Traits\Logger;
use Exception;
use Image;
use Storage;

class StorageController extends Controller
{
    use Logger;

    public function getImage($module, $id)
    {
        $response = new Response();

        try {

            // Validating the module argument
            $service = $this->getServiceByModule($module);

            $source = $service->get($id);

            if (!$source->image) {
                throw new DataNotFound;
            }

            $image = Image::make(Storage::path($source->image));

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

}
