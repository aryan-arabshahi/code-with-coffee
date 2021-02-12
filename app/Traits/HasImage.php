<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Storage;

trait HasImage
{

    /**
     * Generate the image link
     * 
     * @param string $module
     * @param string $id
     * @param null|string $imageName = null
     * 
     * @return string
     */
    private function generateImageLink(
        string $module,
        string $id,
        null|string $imageName = null
    ): string
    {
        $actual_name = '';
        if ($imageName) {
            $exploded_name = explode('/', $imageName);
            $actual_name = end($exploded_name);
        }
        return route('storage.getImage', [$module, $id, $actual_name]);
    }

    /**
     * Get the cover field
     * 
     * @param mixed $value
     * 
     * @return mixed
     */
    public function getImageUrlAttribute(mixed $value): mixed
    {
        return ($this->id AND $this->image) ?
            $this->generateImageLink(
                $this->module,
                $this->id,
                $this->image
            )
        :
            null;
    }

    /**
     * Store the specified image
     * 
     * @param UploadedFile $file
     * 
     * @return string
     */
    public function storeImage(UploadedFile $file): string
    {
        return $file->store(storage_image_path($this->module));
    }

    /**
     * Remove the specified image
     * 
     * @param null|string $filePath The storage path of the file
     * 
     * @return void
     */
    public function removeImage(null|string $filePath): bool
    {
        return ($filePath AND Storage::exists($filePath)) ?
            Storage::delete($filePath)
        :
            true;
    }

}
