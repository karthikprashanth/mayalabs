<?php
	class Model_Functions {
		
		public function pathFormat($path)
		{
			$i = 0;
			$formattedPath = "";
			for($i=0;$i<strlen($path);$i++)
			{
				if(ord(substr($path,$i,1)) == 92)
				{
					$formattedPath = $formattedPath . chr(47);
				}
				else {
					$formattedPath = $formattedPath . substr($path,$i,1);
				}
			}
			return $formattedPath;
		}
		
		public function getFileExt($filepath)
		{
			$i=0;
			for($i=0;$i<strlen($filepath);$i++)
			{
				if(substr($filepath,$i,1) == '/')
				{
					$pos = $i;
				}
			}
			$filename = substr($filepath,$pos+1,strlen($filepath)-$pos);
			$i=0;
			for($i=0;$i<strlen($filename);$i++)
			{
				if(substr($filename,$i,1) == '.')
				{
					$pos = $i;
				}
			}
			$ext = substr($filename,$pos+1,strlen($filename)-$pos); 
			return $ext;
			
		}
	}
?>