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
		
		public static function highlightResults($query,$text)
		{
			
			$keywords = explode(" ",$query);
			if(count($keywords) == 0)
			{
				$keywords[0] = $query;
			}
			$words = explode(" ",$text);
			for($i=0;$i<count($keywords);$i++)
			{
				for($j=0;$j<count($words);$j++)
				{
					if(strtolower($keywords[$i]) == strtolower($words[$j])
					|| Model_Functions::strIsPartOf(strtolower($keywords[$i]),strtolower($words[$j]))
					)
					{
						$words[$j] = "<span class = 'search-highlighter' style = 'font-weight: bold;color: #1A4C80;background-color : #c1e199;'>" . $words[$j] . "</span>";
					}
				}
			}
			$output = implode(" ",$words);
			return $output;
			
		}
		
		public static function highlightEOH($from,$to,$eoh)
		{
			if((int)$eoh >= $from && (int)$eoh <= $to)
			{
				$eoh = "<span class = 'search-highlighter' style = 'font-weight: bold;color: #1A4C80;background-color : #c1e199;'>" . $eoh . "</span>";
			}
			return $eoh;
		}
		public static function strIsPartOf($str1,$str2)
		{
			
			if(strlen($str1) > strlen($str2))
			{
				$max = strlen($str1);
				$maxstr = $str1;
				$min = strlen($str2);
				$minstr = $str2;
			}
			else {
				$max = strlen($str2);
				$maxstr = $str2;
				$min = strlen($str1);
				$minstr = $str1;
			}
			if ($min <= 4)
			{
				return false;
			}
			for($i=0;$i<$max;$i++)
			{
				if(strtolower($minstr) == substr($maxstr,$i,$min))
				{
					return true;
				}
			}
			return false;
		}
	}
?>