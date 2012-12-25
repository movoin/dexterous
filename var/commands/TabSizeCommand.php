<?php
/**
 * 替换文件中 Tab 为 4 个空格
 * 替换 \r\n 为 \n
 *
 * @copyright  Copyright (c) 2009 - 2010 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @package    dexterous
 * @category   commands
 * @author     Allen <movoin@gmail.com>
 * @version    $Id$
 */

class TabSizeCommand extends CConsoleCommand
{
    public function getHelp()
    {
        return <<<EOD
USAGE
  yiic tabsize <document-root>

DESCRIPTION
  This command searches for php files in the path, to be replaced tab with-
  4 spaces.

PARAMETERS
 * document-root: required, the path of the document root.

EOD;
    }

    /**
     * Execute the action.
     * @param array command line parameters specific for this command
     */
    public function run($args)
    {
        if (!isset($args[0]))
            $this->usageError('the document root path is not specified.');
        if (!$path = realpath($args[0]))
            $this->usageError("the document root path {$args[0]} does not exists.");

        $this->tabsize($path);
    }

    /**
     * 替换 Tab
     *
     * @param string $dir
     * @access protected
     */
    protected function tabsize($dir)
    {
        if($files = $this->getFiles($dir, true, 'php'))
        {
            foreach($files as $file)
            {
                if($contents = file_get_contents($dir . '/' . $file))
                {
                    $lines = preg_split("(\r\n|\r|\n)", $contents);
                    $result = array();
                    foreach($lines as $line)
                    {
                        preg_match("/^(\s+)(.*)$/", $line, $out);
                        if($out && strlen($out[1]) > 0)
                            $line = str_replace("\t", '    ', $out[1]) . $out[2];

                        $result[] = rtrim($line, "\r\n") . "\n";
                    }

                    file_put_contents($dir . '/' . $file, trim(implode('', $result)) . "\n");

                    echo "Replaced file {$dir}/{$file} is done.\n";
                }
            }
        }

        if($dirs = $this->getDirs($dir))
        {
            foreach($dirs as $indir)
                $this->tabsize($dir . '/' . $indir);
        }
    }

    /**
     * 获得一个目录下的文件
     *
     * @param string $inpath
     * @param boolean $trim 是否裁剪, true: 返回文件名(不含后缀), 默认: false
     * @param string $stamp 文件后缀
     * @access private
     * @return array
     */
    private function getFiles($inpath, $trim=false, $stamp=null)
    {
        $files = array();
        if(!is_dir($inpath))
            return $files;

        $it = new DirectoryIterator($inpath);
        $stamp = (null === $stamp) ? null : explode("|", $stamp);

        foreach($it as $file)
        {
            if($file->isFile())
            {
                $file = $file->__toString();
                $fileExt = (false === ($pos = strrpos($file, '.'))) ? null : substr($file, $pos+1);
                $fileName = (false === $pos) ? $file : substr($file, 0, $pos);

                if(null !== $stamp && in_array($fileExt, $stamp))
                    $files[] = $trim ? $file : $fileName;
                else if(null === $stamp)
                    $files[] = $trim ? $file : $fileName;
            }
        }
        return $files;
    }

    /**
     * 获得一个目录下的目录
     *
     * @param string $inpath
     * @access private
     * @return array
     */
    private function getDirs($inpath)
    {
        $dirs = array();
        if(!is_dir($inpath))
            return $dirs;

        $it = new DirectoryIterator($inpath);
        foreach($it as $dir) {
            if($dir->isDir() && !$dir->isDot())
                $dirs[] = $dir->__toString();
        }
        return $dirs;
    }
}
