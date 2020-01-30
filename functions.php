<?php

/**
* WordPress helper functions
*/


if(!function_exists('rrmdir')) { 

    # http://stackoverflow.com/a/3352564/283851
    # https://gist.github.com/XzaR90/48c6b615be12fa765898

    # Forked from https://gist.github.com/mindplay-dk/a4aad91f5a4f1283a5e2

    /**
     * Recursively delete a directory and all of it's contents - e.g.the equivalent of `rm -r` on the command-line.
     * Consistent with `rmdir()` and `unlink()`, an E_WARNING level error will be generated on failure.
     *
     * @param string $source absolute path to directory or file to delete.
     * @param bool   $removeOnlyChildren set to true will only remove content inside directory.
     *
     * @return bool true on success; false on failure
     */
    function rrmdir($source, $removeOnlyChildren = false)
    {
        if(empty($source) || file_exists($source) === false)
        {
            return false;
        }

        if(is_file($source) || is_link($source))
        {
            return unlink($source);
        }

        $files = new RecursiveIteratorIterator
        (
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        //$fileinfo as SplFileInfo
        foreach($files as $fileinfo)
        {
            if($fileinfo->isDir())
            {
                if(rrmdir($fileinfo->getRealPath()) === false)
                {
                    return false;
                }
            }
            else
            {
                if(unlink($fileinfo->getRealPath()) === false)
                {
                    return false;
                }
            }
        }

        if($removeOnlyChildren === false)
        {
            return rmdir($source);
        }

        return true;
    }
}


if(!function_exists('dd')) {

    /**
     * Dump and die
     */
    function dd($var, $objects = null) {
        var_dump($var, $objects);
        die;
    }

}


if(!function_exists('dump')) {

    /**
     * Dump and die
     */
    function dump($var) {
        print_r($var);
        die;
    }

}