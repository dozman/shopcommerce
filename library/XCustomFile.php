<?php
/**
 * XCustom Http
 *
 * @author  Peter Ramokone
 * @package Http Request & Response Handler
 */
class XCustomFile{
	
	/**
	 * get list of supported mimes
	 * 
	 * @return arary(extension => mime)
	 */
	public static function  getSupportedMimes(){
		return	array(	'eml'		=> 'message/rfc822',														
						'hqx'		=> 'application/mac-binhex40', 	
						'cpt'		=> 'application/mac-compactpro',		
						'doc'		=> 'application/msword', 
						'docx'		=> 'application/msword',
						'dot'		=> 'application/msword',									
						'bin'		=> 'application/macbinary',
						'dms'		=> 'application/octet-stream',
						'lha'		=> 'application/octet-stream',			
						'lzh'		=> 'application/octet-stream',
						'exe'		=> 'application/octet-stream', 					
						'class'		=> 'application/octet-stream',			
						'so'		=> 'application/octet-stream',
						'dll'		=> 'application/octet-stream', 					
						'pdf'		=> 'application/pdf',		
						'oda'		=> 'application/oda',			
						'ai'		=> 'application/postscript',
						'eps'		=> 'application/postscript',					
						'ps'		=> 'application/postscript',			
						'smi'		=> 'application/smil',
						'smil'		=> 'application/smil',							
						'wbxml'		=> 'application/vnd.wap.wbxml', 		
						'wmlc'		=> 'application/vnd.wap.wmlc',
						'wmlsc'		=> 'application/vnd.wap.wmlscriptc',			
						'xla'		=> 'application/vnd.ms-excel',			
						'xls'		=> 'application/vnd.ms-excel', 
						'xlt'		=> 'application/vnd.ms-excel', 	
						'csv'		=> 'application/vnd.ms-excel',				
						'ppt'		=> 'application/vnd.ms-powerpoint',	
						'xlsx'		=> 'application/vnd.ms-excel',									
						'csh'		=> 'application/x-csh',
						'dcr'		=> 'application/x-director',					
						'dir'		=> 'application/x-director',			
						'dxr'		=> 'application/x-director',
						'spl'		=> 'application/x-futuresplash',				
						'gtar'		=> 'application/x-gtar',				
						'php'		=> 'application/x-httpd-php',
						'php3'		=> 'application/x-httpd-php',					
						'php5'		=> 'application/x-httpd-php',			
						'phtml'		=> 'application/x-httpd-php',
						'js'		=> 'application/x-javascript',					
						'sh'		=> 'application/x-sh',					
						'swf'		=> 'application/x-shockwave-flash',
						'sit'		=> 'application/x-stuffit', 					
						'tar'		=> 'application/x-tar',					
						'tcl'		=> 'application/x-tcl',
						 'xhtml'	=> 'application/xhtml+xml', 					
						 'xht'		=> 'application/xhtml+xml', 			
						 'xhtml'	=> 'application/xml',
						 'ent'		=> 'application/xml-external-parsed-entity',	
						 'dtd'		=> 'application/xml-dtd', 				
						 'mod'		=> 'application/xml-dtd',
						 'gz'		=> 'application/x-gzip',						
						 'zip'		=> 'application/zip',
						 'kar'		=> 'audio/midi',					
						 'au'		=> 'audio/basic',	
						 'snd'		=> 'audio/basic',								
						 'mid'		=> 'audio/midi',						
						 'midi'		=> 'audio/midi',	
						 'mp1'		=> 'audio/mpeg',								
						 'mp2'		=> 'audio/mpeg',						
						 'mp3'		=> 'audio/mpeg',	
						 'aif'		=> 'audio/x-aiff',								
						 'aiff'		=> 'audio/x-aiff',						
						 'm3u'		=> 'audio/x-mpegurl',	
						 'ram'		=> 'audio/x-pn-realaudio',						
						 'rm'		=> 'audio/x-pn-realaudio', 				
						 'rpm'		=> 'audio/x-pn-realaudio-plugin',	
						 'ra'		=> 'audio/x-realaudio',							
						 'wav'		=> 'audio/x-wav',						
						 'bmp'		=> 'image/bmp',	
						 'gif'		=> 'image/gif',									
						 'jpeg'		=> 'image/jpeg',						
						 'jpg'		=> 'image/jpeg',	
						 'jpe'		=> 'image/jpeg',								
						 'png'		=> 'image/png',							
						 'tiff'		=> 'image/tiff',	
						 'tif'		=> 'image/tif',									
						 'wbmp'		=> 'image/vnd.wap.wbmp',				
						 'pnm'		=> 'image/x-portable-anymap',	
						 'pbm'		=> 'image/x-portable-bitmap',					
						 'pgm'		=> 'image/x-portable-graymap',			
						 'ppm'		=> 'image/x-portable-pixmap',	
						 'xbm'		=> 'image/x-xbitmap',							
						 'xpm'		=> 'image/x-xpixmap',
						 'tsv'		=> 'text/tab-seperated-values',					
						 'ics'		=> 'text/calendar',	
						 'ifb'		=> 'text/calendar',						
						 'html'		=> 'text/html',	
						 'htm'		=> 'text/html',									
						 'asc'		=> 'text/plain',						
						 'txt'		=> 'text/plain',	
						 'rtf'		=> 'text/rtf',	
						 'log'		=> 'text/plain',
						 'rtx'		=> 'text/richtext',								
						 'sgml'		=> 'text/x-sgml',						
						 'sgm'		=> 'text/x-sgml', 	
						 'wml'		=> 'text/vnd.wap.wml',							
						 'wmls'		=> 'text/vnd.wap.wmlscript',			
						 'xsl'		=> 'text/xml',	
						 'mpeg'		=> 'video/mpeg',								
						 'mpg'		=> 'video/mpeg',						
						 'mpe'		=> 'video/mpeg',	
						 'qt'		=> 'video/quicktime',							
						 'mov'		=> 'video/quicktime',					
						 'avi'		=> 'video/x-msvideo',
						 'movie'	=>	'video/x-sgi-movie',
						 'rv'		=>	'video/vnd.rn-realvideo',
						 'rss'		=>	'application/rss+xml',	
				
						 'css'		=> 'text/css',									
						 'js'		=> 'application/x-javascript',									
						 'ico'		=> 'image/x-icon',									
						 'eot'		=> 'application/vnd.ms-fontobject',									
						 'svg'		=> 'image/svg+xml',									
						 'ttf'		=> 'application/font-sfnt',									
						 'woff'		=> 'application/font-woff',	
						 'otf'		=> 'application/font-sfnt',
						 'woff2'	=> 'font/woff2',
						 );
	}
	
	/**
	 * get the width of the image
	 *
	 * @param string $image - filepath
	 * 
	 * @return int - pixes
	 */
	public static function getImageWidth($image)
	{
		if(self::exists($image) and is_file($image)){
			return array_shift(getimagesize($image));
		}
		return;		
	}
	
	/**
	 * get the height of the image
	 *
	 * @param string $image - filepath
	 * 
	 * @return int - pixes
	 */
	public static function getImageHeight($image)
	{
		if(self::exists($image) and is_file($image)){
			return array_shift(array_slice(getimagesize($image),1));
		}
		return;		
	}
	
	/**
	 * get file extension
	 *
	 * @param string $file
	 * 
	 * @return string
	 */
	public static function getExtension($file){
		$file = pathinfo($file);
		return !empty($file['extension']) ? strtolower($file['extension']) : null;
	} 
	
	/**
	 * get the file mime type
	 *
	 * @param string $filename
	 * 
	 * @return string - false on failiar
	 */
	public static function getMime($filename){
		$supported_mimes = self::getSupportedMimes();
			
		if(isset($supported_mimes[self::getExtension($filename)])){
			return $supported_mimes[self::getExtension($filename)];
		}
		return false;
	}
	
	/**
	 * get the content of a file
	 *
	 * @param string $file
	 * 
	 * @return string
	 * 
	 * @exception throws exception on file not found
	 */
	public static function getContent($file){		
		if(is_file($file) && self::exists($file) ){			
			if(function_exists('file_get_contents')){
				return file_get_contents($file);
			}
			else {
				return implode("", file($file));
			}
		}
		throw new Exception('<strong>[lang-file-not-found]:</strong><br />'.$file);
	}
	
	/**
	 * check if the given filename is a supported web image
	 * - webs images are any file of extension: jpg, gif or png
	 *
	 * @param string $filename
	 * @param array $extentions
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isWebImage($filename, $extentions = array('jpg','jpeg','gif','png')){
		$ext = strtolower(self::getExtension($filename));
		return (in_array($ext, $extentions));
	}
	
	/**
	 * check if the given filename is a supported Document
	 * -Document are any file of extension: pdf, doc, xls, xlsx, docx, pps, ppsx, ppt, pptx, txt, rtf, csv, mpp
	 *
	 * @param string $filename
	 * @param array $extentions
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isDocument($filename, $extentions = array('pdf','doc','xls','xlsx','docx','pps','ppsx','ppt','pptx','txt','rtf','csv','mpp','zip','tar','rar') ){
		$ext = strtolower(self::getExtension($filename));
		return (in_array($ext, $extentions));
	}
		
	/**
	 * check if the given filename is a supported Media
	 * -Document are any file of extension: avi, 3gpp, mp4, mpeg, mp3, wma, swf, flv
	 *
	 * @param string $filename
	 * @param array $extentions
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isMedia($filename, $extentions = array('avi','3gpp','mp4','mpeg','wmv','mov','flv','mp3','wma', 'wav')){
		$ext = strtolower(self::getExtension($filename));
		return (in_array($ext,$extentions));
	}
	
	/**
	 * check if the given filename is a supported image
	 * - webs images are any file of extension: jpg, gif, png, bmp, 
	 *
	 * @param string $filename
	 * @param array $extentions
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isImage($filename, $extentions = array('jpg','jpeg','gif','png', 'bmp','tiff','ico')){
		$ext = strtolower(self::getExtension($filename));
		return (in_array($ext, $extentions));
	}
	
		
	/**
	 * check if the given filename is a supported Audio
	 * -Document are any file of extension: mp3, wma, wav
	 *
	 * @param string $filename
	 * @param array $extentions
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isAudio($filename, $extentions = array('mp3','wma', 'wav')){
		$ext = strtolower(self::getExtension($filename));
		return (in_array($ext,$extentions));
	}
	
		
	/**
	 * check if the given filename is a supported Video
	 * -Document are any file of extension: avi, 3gpp, mp4, mpeg, wmv, mov , flv
	 *
	 * @param string $filename
	 * @param array $extentions
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isVideo($filename, $extentions = array('avi','3gpp','mp4','mpeg','wmv','mov','flv')){
		$ext = strtolower(self::getExtension($filename));
		return (in_array($ext,$extentions));
	}
	
	/**
	 * Check if the file is a multimedia
	 * - WebImage, Document & Media(Sound & video)
	 *
	 * @param string $filename
	 *  
	 * @return boolean - false when the file extension is not supported
	 */
	public static function isMultimedia($filename){
		if(self::isImage($filename)){
			return true;
		}
		
		if(self::isDocument($filename)){
			return true;
		}
		
		if(self::isMedia($filename)){
			return true;
		}
		return false;
	}
	
	
	/**
	 * check if the given filename is a compared extension
	 *
	 * @param string $filename : e.g file.png
	 * @param mixed $extension : png or array(png,jpg)
	 * 
	 * @return boolean - false on failiar
	 */
	public static function isExtension($filename,$extension){
		$ext = strtolower(self::getExtension($filename));
		
		if(is_array($extension)){
			return (in_array($ext,$extension));	
		}
		
		return ($ext == strtolower($extension));
	}
	
	/**
	 * Given a string containing a path to a file, 
	 * this function will return the base name of the file. 
	 * 
	 * If the filename ends in suffix this will also be cut off. 
	 *
	 * @param string $filename
	 * 
	 * @return string
	 */
	public static function getFilename($filename){
		return basename($filename);
	}
	
	/**
	 * delete a file from the system
	 * 
	 * @param string $file - file name "full path of the file"
	 * 
	 * @return boolean
	 */
	public static function deleteFile($file){
		if(self::exists($file)){
			return unlink($file);
		}
		return false;
	}
	 
	/**
	 * upload a temporary file
	 * 
	 * - this will try to move uploaded file
	 * - will allow run the chmod to the new file
	 *
	 * @param string temporary file name $tmp_file - this is form the forms i.e. $_FILES['image']['tmp_name']
	 * @param string $new_filename - the name of the file
	 * @param int $chmod - permissions to the file
	 * @param boolean $create_storage_if_not_exists - optional default false
	 * 
	 * @return boolean
	 */
	public static function uploadTemporaryFile($tmp_file, $new_filename, $chmod = 0755, $create_storage_if_not_exists = false){
		// check if we existing 
		$file_info = pathinfo($new_filename);
		
		// check if directory exist
		if(!self::exists($file_info['dirname'], $is_file = false)){
			// create a directory
			mkdir($file_info['dirname'], $chmod ? $chmod : 0755, $recursive = true);
		}
		
		// still failed to create directory
		if(!self::exists($file_info['dirname'], $is_file = false)){
			return false;
		}
		
		// apply permissions to the directory
		mkdir($file_info['dirname'], $chmod ? $chmod : 0755, $recursive = true);
		
		// upload the file
		if(! move_uploaded_file($tmp_file,$new_filename)){
			return false;
		}
		
		// return true
		return true;
	}
	
	/**
	 * create or overwrite the content of a file
	 *
	 * @param string $file
	 * @param string $content
	 * @param mixed $flag - (PHP 5) for the flag usage please see http://www.php.net/manual/en/function.file-put-contents.php
	 * 
	 * @return boolean if file was set successfully
	 */
	public static function putContent($file, $content, $flag = 0){	
		$directory = self::getDirectory($file);
		
		// check if directory exist
		if($directory && !self::exists($directory, $is_file = false)){
			// create a directory
			mkdir($directory, 0755, $recursive = true);
		}
		
		/**
		 * check if the function "file_put_contents" exists
		 */
		if (!function_exists('file_put_contents')) {		   
	        $filehandler = fopen($file, 'w');
	        if (!$filehandler) {
	            return false;
	        } 
	        else {
	            fwrite($filehandler, $content);
	            fclose($filehandler);
	            return true;
	        }
		}
		else{
			return file_put_contents($file, $content, $flag);
		}
	}	
	
	/**
	 * download file 
	 *
	 * @param string $file_name: freindly file name for downloading
	 * @param string $file_path: file on the system including the full path
	 * @param boolean $delete_file_when_done - optional: default: true
	 * 
	 * @return void
	 */
	public static function downloadFile($file_name, $file_path, $delete_file_when_done = false){
		
		// set time to unlimited	
		set_time_limit(0);
		
		// get file size
		$file_size = self::size($file_path);
		
		header("X-Application: XCustom");	
		header("X-Package: XCustomFile");
		
		// set mime: use application/octet-stream
		if(!$mime = self::getMime($file_name)){
			$mime = 'application/octet-stream';
		}
		
		// add no cahche header
		XCustomHttp::addNoCacheHeaders();
		
		header("Content-Description: File Transfer");
		header("Content-Type: {$mime}");	
		header("Content-Type: application/force-download");	
		header("Content-transfer-encoding: binary");
		header("Content-Disposition: attachment; filename=\"{$file_name}\"");
		header("Content-Length: ".$file_size); 
		
		//start the download
		readfile($file_path);
				
		// dlete file when done
		if($delete_file_when_done){
			self::deleteFile($file_path);
		}
		
		// end
		exit;
	}
	
	/**
	 * download files 
	 *
	 * @param $files array('name' 		=> , freindly file name for downloading
	 * 				'path' 		=> , file on the system including the full path if type is file
	 * 				'content' 	=> , binary content of the file if type is content
	 * 				'type' 		=> 'file/content' -
	 * 				)
	 * @param string $download_name - optional:  name of the package file to download i.e. files.zip
	 * 
	 * @return void
	 */
	public static function downloadFiles($files, $download_name = 'files.zip'){
		// continue if we have files
		if(empty($files)){return;}
		
		// list of supported mimes
		$supported_mimes = self::getSupportedMimes();
		
		// get mime for format requested
		$file_mime 		= self::getMime($download_name);
		
		// get extension for format requested
		$file_extension = self::getExtension($download_name);
		
		// download file based of mime
		switch($file_mime){
			case 'application/zip':
			case 'application/x-gzip':
			case 'application/x-tar':
			case 'application/x-gtar':
				// create the temporary file
				$system_name = sys_get_temp_dir(). DIRECTORY_SEPARATOR . md5($download_name).".{$file_extension}";
		
				// create the archive
			    $objZip = new ZipArchive();
				
				// add file coments headers
				$objZip->setCommentName('Framework', 	'XCustomApp');
				$objZip->setCommentName('Package', 		'XCustomFile');
								
				// open zip file for writting
			    if( $objZip->open($system_name,ZIPARCHIVE::CREATE) !== true ) {
			      	throw new Exception('No write permission for package download.');
			    }
				// successful total files
				$file_counter = 0;
				
			    // add the files
			    foreach($files as $file) {
			    	// add file or content to zip package
			    	$file_type = !empty($file['type']) ? $file['type'] : null;
					
			    	switch($file_type){
			    		// add file using path
						case 'file':
							// add an existing file
							if( self::exists($file['path']) ){								
								$objZip->addFile($file['path'], $file['name']);
								$file_counter++;
							}
						break;
							
						// add file using binary content
						case 'content':
							// add an existing file
							if( !empty($file['content']) ){
								$objZip->addFromString($file['name'], $file['content']);
								$file_counter++;
							}
						break;
			    	}			    	
			    }
				
				// add total file as a comment
				$objZip->setCommentName('Totalfiles',$objZip->numFiles);
				
			    //close the zip
			    $objZip->close();
				
				// start file delete
				self::downloadFile($download_name, $system_name, $delete_file_when_done = true);
			break;
			
			default:
				throw new Exception('Mime file not supported in package download.');
			break;
		}
	}
	
	/**
	 * download content 
	 *
	 * @param string $file_name
	 * @param string $file_content
	 * @param array $extra_headers - optional
	 * 
	 * @return void
	 */
	public static function downloadContent($file_name, $file_content, $extra_headers = null){
		
		// set time to unlimited	
		set_time_limit(0);
		
		header("X-Application: XCustom");	
		header("X-Package: XCustomFile");
		
		// set mime: use application/octet-stream
		if(!$mime = self::getMime($file_name)){
			$mime = 'application/octet-stream';
		}
		
		// add no cahche header
		XCustomHttp::addNoCacheHeaders();
		
		header("Content-Description: File Transfer");
		header("Content-Type: {$mime}");	
		header("Content-Type: application/force-download");	
		header("Content-transfer-encoding: binary");
		header("Content-Disposition: attachment; filename=\"{$file_name}\"");
		header("Content-transfer-encoding: binary");
		
		if(!empty($extra_headers)){
			foreach($extra_headers as $header){
				header($header);	
			}
		}
		echo $file_content;
		
		// end
		exit;
	}
	
	/**
	 * get system temporary directory
	 *
	 * @return string
	 */
	public static function getSystemTemporaryDirectory(){
		return sys_get_temp_dir() . DIRECTORY_SEPARATOR;
	}
	
	
	/**
	* This help to retirve the image ID using the image name
	* 
	* @param string version
	* @return int - 0 if an image extension is passed
	**/
	public static function getImageIdByFilename($image_name){
		
		$image_name = explode('.',$image_name);
		$image_extension = strtolower(end($image_name));
		switch($image_extension){
			case 'jpg':
			case 'jpeg':
				return IMAGETYPE_JPEG;
			break;
			case 'gif':
				return IMAGETYPE_GIF;
			break;
			case 'png':
				return IMAGETYPE_PNG;
			break;
			default:
				return 0;
			break;			
		}
	}
	
	/**
	 * create a csv file
	 * 
	 * @param string $filename
	 * @param array $labels
	 * @param array $data
	 * @param int $mode  - optional : default = 1
	 * 			 - 1 = downoad when done
	 * 			 - 2 = save file when done
	 * 			 - 3 = return content when done
	 * 			 
	 * @return mixed
	 */
	public static function createCSV($filename, $labels, $data, $mode = 1){
		// create the temporary file
		$system_name = self::getSystemTemporaryDirectory(). sha1($filename).'.csv';
		$temp = fopen($system_name, 'w');
		
		// set header
		fputcsv($temp,$labels);
				
		// records
		foreach($data as $entry){
			// add data
			$record = array();
			// apply html special chars on data
			foreach($entry as $value){$record[] = htmlspecialchars(strip_tags($value));}
			fputcsv($temp,$record);		
		}	

		// this removes the file
		fclose($temp);
		
		// when done
		switch($mode){
			// save file
			case 2:
				rename($system_name, $filename);
			break;
			
			//return content
			case 3:
				return self::getContent($system_name);
			break;
				
			// download file
			case 1:
			default:
				self::downloadFile($filename, $system_name, true);
				// end process
				exit;
			break;
		}
	}

	/**
	 * check if file exists
	 * 
	 * @param string $filename
	 * @param boolean $as_file - optional: default = true, if false just check for files and directories
	 * 
	 * @return boolean 
	 */
	public static function exists($filename, $as_file = true){
		return $filename && file_exists($filename) && (!$as_file || ($as_file && is_file($filename))) ? true : false;
	}

	/**
	 * get the file / directory size
	 * 
	 * @param string $file_name
	 * @param boolean $as_file - optional: default = true, if false just check for files and directories
	 * 
	 * @return int 
	 */
	public static function size($filename, $as_file = true){
		// check as file
		if($as_file)
		{
			// file exists
			return file_exists($filename) ? filesize($filename): 0;
		}
		
		// do not continue on file being pased for directory size check
		if(is_file($filename))
		{
			// continue only if the path is a directory
			return 0;			
		}
		
		// the initial size
		$intSize = 0;
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($filename)) as $file) {
			$intSize += $file->getSize();
		}
		return $intSize;
	}

	/**
	 * rename a file
	 * 
	 * @param string $filename
	 * 
	 * @return boolean
	 */
	public static function rename($old_file, $new_filename){
		// check if we existing 
		$file_info = pathinfo($new_filename);
		
		// check if directory exist
		if(!self::exists($file_info['dirname'], $is_file = false)){
			// create a directory
			mkdir($file_info['dirname'], 0755, $recursive = true);
		}
		
		// still failed to create directory
		if(!self::exists($file_info['dirname'], $is_file = false)){
			return false;
		}
		
		// upload the file
		if(! rename($old_file,$new_filename)){
			return false;
		}
		
		self::deleteFile($old_file);
		
		// return true
		return true;
	}

	/**
	 * get file directory
	 * 
	 * @param string $filename
	 * 
	 * @return string
	 */
	public static function getDirectory($filename){
		$file_info = pathinfo($filename);
		return $file_info['dirname'];
	}
}
