<?php namespace App\Http\Libraries;


class LibFiles {


    /**
     * Upload file
     * Check extension
     * Check size
     * @param type $configs
     * @param array $file
     */
    public function upload($configs, $file){

        //destination path
        $filepath = realpath(base_path($configs['filepath'])); // upload path

        $extension = $file->getClientOriginalExtension(); // getting image extension

        $filename = $configs['prename'].time() . '.' . $extension; // renameing image

        $file->move($filepath, $filename); // uploading file to given path
        //
        // sending back with message
        $fullpath = realpath($filepath . '/' . $filename);

        $fileinfo = array(
            'filename' => $filename,
            'filepath' => $filepath,
            'fullpath' => $fullpath,
        );

        return $fileinfo;
    }
}