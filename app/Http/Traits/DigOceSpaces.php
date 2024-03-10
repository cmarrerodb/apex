<?php
/*
 * Creado por Yorian Lara - Edicion Felix
 * FINTRUCK
 * 2023
 */
namespace App\Http\Traits;

/* Digital Ocean Spaces */
use Illuminate\Support\Facades\Storage;
use File;

trait DigOceSpaces
{
    public function uploadFile($folder, $file, $extension, $name = null, $is_public = false)
	{
		try
		{

			//COLOCAR https://dataloggers.nyc3.digitaloceanspaces.com/ + PATH

			$visibility = $is_public ? 'public' : 'private';
			$disk  		= env('DO_SPACES_DISK','DO');

    		Storage::disk($disk)->makeDirectory($folder);

    		$fileName   = File::hashName($name ? $name : sha1(time()).' '.date('c')).'.'.$extension;
			$filePath	= $folder.'/'.$fileName;

			$saved 		= Storage::disk($disk)->put($filePath, $file);

			if (!$saved) trigger_error("error-do-save-file");

			Storage::disk($disk)->setVisibility($filePath, $visibility);

			$path 			= Storage::disk($disk)->path($filePath);
			$tempUrl 		= Storage::disk($disk)->temporaryUrl($filePath, now()->addMinutes(60));
			$privateUrl 	= Storage::disk($disk)->url($filePath);
			$bytesSize 		= Storage::disk($disk)->size($filePath);
			$humanSize		= File::sizeUnit($bytesSize);
			$Modified		= Storage::disk($disk)->lastModified("{$filePath}");

            return (object)$response = [
				"success" 		=> true,
				"saved" 		=> $saved,
				"modified" 		=> $Modified,
				"name" 			=> $fileName,
				"path" 			=> $path,
				"bytesSize" 	=> $bytesSize,
				"humanSize" 	=> $humanSize,
				"privateUrl"	=> "https://dataloggers.nyc3.digitaloceanspaces.com/".$path,
			];
        }
        catch (\Exception $e)
        {
			return (object)[
                'success'   => false,
                'code'      => $e->getCode(),
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
            ];
        }
	}

	public function getFile($path)
	{
		try
		{
			$contents = Storage::disk(env('DO_SPACES_DISK','DOspacesDev'))->get($path);
			return $contents;
		}
        catch (\Exception $e)
        {
			return (object)[
                'success'   => false,
                'code'      => $e->getCode(),
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
            ];
        }
	}

	public function deleteFile($file)
	{
		try
		{

			$deleted 	= false;
			$success 	= false;

			if($file!="")
			{
				$disk 		= env('DO_SPACES_DISK','DO');
				$raiz 		= "https://dataloggers.nyc3.digitaloceanspaces.com/";
				$file 		= str_replace($raiz,"",$file);
				$exists 	= Storage::disk($disk)->has($file);

				if ($exists) {
					$deleted = Storage::disk($disk)->delete($file);
					if(!$deleted) trigger_error("error DO delete file");
				}

				$success = true;
			}
			else
			{
				$success 	= true;
				$deleted 	= true;
			}

			return (object)[
				"success" 		=> $success,
				"deleted" 		=> $deleted
			];
        }
        catch (\Exception $e)
        {
			return (object)[
                'success'   => false,
                'code'      => $e->getCode(),
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
            ];
        }
	}

	public function deleteDirectory($directory)
	{
		try
		{
			$disk 		= env('DO_SPACES_DISK','DOspacesDev');
			$deleted 	= Storage::disk($disk)->deleteDirectory($directory);

			if(!$deleted) trigger_error("error-do-delete-file");

			return (object)[
				"success" 		=> true,
				"deleted" 		=> $deleted
			];
        }
        catch (\Exception $e)
        {
			return (object)[
                'success'   => false,
                'code'      => $e->getCode(),
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine()
            ];
        }
	}

	public function uploadProfilePicture($picture, $name='')
    {
        return $this->uploadFile('profiles_pic', base64_decode(str_replace('data:image/png;base64,','', $picture)), 'png', $name, true);
    }

    public function getFullFile($pathFile)
    {
    	$disk 		= env('DO_SPACES_DISK','DO');
		$raiz 		= "https://dataloggers.nyc3.digitaloceanspaces.com/";
		$file 		= str_replace($raiz,"",$pathFile);
		$exists 	= Storage::disk($disk)->has($file);

    	if($exists)
    	{
    		$file 	   	= Storage::disk($disk)->get($file);
    		$mimetype 	= $this->get_mime_type($file);
   			return ['file' => $file,'mime' => $mimetype];
    	}
    	else
    	{
    		return false;
    	}

    }

    function get_mime_type($filename)
    {
		$idx = explode( '.', $filename );
		$count_explode = count($idx);
		$idx = strtolower($idx[$count_explode-1]);

		$mimet = array(
		'txt' 	=> 'text/plain',
		'htm' 	=> 'text/html',
		'html' 	=> 'text/html',
		'php' 	=> 'text/html',
		'css' 	=> 'text/css',
		'js' 	=> 'application/javascript',
		'json' 	=> 'application/json',
		'xml' 	=> 'application/xml',
		'swf' 	=> 'application/x-shockwave-flash',
		'flv' 	=> 'video/x-flv',

		// images
		'png' 	=> 'image/png',
		'jpe' 	=> 'image/jpeg',
		'jpeg' 	=> 'image/jpeg',
		'jpg' 	=> 'image/jpeg',
		'gif' 	=> 'image/gif',
		'bmp' 	=> 'image/bmp',
		'ico' 	=> 'image/vnd.microsoft.icon',
		'tiff' 	=> 'image/tiff',
		'tif' 	=> 'image/tiff',
		'svg' 	=> 'image/svg+xml',
		'svgz' 	=> 'image/svg+xml',

		// archives
		'zip' 	=> 'application/zip',
		'rar' 	=> 'application/x-rar-compressed',
		'exe' 	=> 'application/x-msdownload',
		'msi' 	=> 'application/x-msdownload',
		'cab' 	=> 'application/vnd.ms-cab-compressed',

		// audio/video
		'mp3' 	=> 'audio/mpeg',
		'qt' 	=> 'video/quicktime',
		'mov' 	=> 'video/quicktime',

		// adobe
		'pdf' 	=> 'application/pdf',
		'psd' 	=> 'image/vnd.adobe.photoshop',
		'ai' 	=> 'application/postscript',
		'eps' 	=> 'application/postscript',
		'ps' 	=> 'application/postscript',

		// ms office
		'doc' 	=> 'application/msword',
		'rtf' 	=> 'application/rtf',
		'xls' 	=> 'application/vnd.ms-excel',
		'ppt' 	=> 'application/vnd.ms-powerpoint',
		'docx' 	=> 'application/msword',
		'xlsx' 	=> 'application/vnd.ms-excel',
		'pptx' 	=> 'application/vnd.ms-powerpoint',

		// open office
		'odt' 	=> 'application/vnd.oasis.opendocument.text',
		'ods' 	=> 'application/vnd.oasis.opendocument.spreadsheet',
		);

		if (isset( $mimet[$idx] )) {
			return $mimet[$idx];
		} else {
			return 'application/octet-stream';
		}
 	}

	public function get_public_url($pathFile,$min=60)
	{
		$disk 	= env('DO_SPACES_DISK','DO');
		$raiz 	= "https://dataloggers.nyc3.digitaloceanspaces.com/";
		$pathFile = str_replace($raiz,"",$pathFile);
    	$exists = Storage::disk($disk)->has($pathFile);
    	if($exists)
    	{
			$tempUrl = Storage::disk($disk)->temporaryUrl($pathFile, now()->addMinutes($min));
			// $tempUrl = str_replace("https://dataloggers.nyc3.digitaloceanspaces.com/",$raiz,$tempUrl);
		}
		else
		{
			$tempUrl = false;
		}

		return $tempUrl;
	}
}
