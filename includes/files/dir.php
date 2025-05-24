<?php
/*
 *    Function to check recursively, if dirname exists in directory's tree.
 *
 *    @param string $dir_name
 *    @param string [$path]
 *    @return bool
 */
function dir_exists($dir_name = false, $path = './')
{
    if(!$dir_name)
    {
    	return false;
    }

    if(is_dir($path.$dir_name))
    {
    	return true;
    }

    $tree = glob($path.'*', GLOB_ONLYDIR);

    if($tree && count($tree)>0) {
        foreach($tree as $dir)
            if(dir_exists($dir_name, $dir.'/'))
                return true;
    }

    return false;
}
?>
