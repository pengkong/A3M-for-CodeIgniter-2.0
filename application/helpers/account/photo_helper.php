<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Shows users photo
 * @param string $picture Description
 * @param Array $param Array with parameters to be included in the generated img tag (height, width, id, align, check, nocache, title, class)
 * @return string
 */
function showPhoto($picture = NULL, $param = NULL)
{

	// usable parameters for photo display
	$height = (isset($param['height'])) ? $param['height'] : 100;
	$width = (isset($param['width'])) ? $param['width'] : 100;
	$id = (isset($param['id'])) ? $param['id'] : FALSE;
	$align = (isset($param['align'])) ? $param['align'] : "absmiddle";
	$check = (isset($param['check'])) ? $param['check'] : FALSE;
	$nocache = (isset($param['nocache'])) ? $param['nocache'] : FALSE; // TRUE = disable caching, add time string to image url
	$title = (isset($param['title'])) ? $param['title'] : "User's Photo";
	$class = (isset($param['class'])) ? $param['class'] : "user-photo";

	if (isset($picture) && strlen(trim($picture)) > 0)
	{
		$remote = stristr($picture, 'http'); // do a check here to see if image is from twitter / facebook / remote URL

		if ( ! $remote)
		{
			if ($nocache)
			{
				$picture = $picture.'?t='.md5(time());
			} // only if $nocache is TRUE
			$path = site_url(RES_DIR.'/user/profile/'.$picture); //.		-- disabled time attachment, no need to break cache
		}
		else
		{

			$path = $picture;

			// request proper cropped size from facebook for this photo
			if (stripos($path, 'graph.facebook.com'))
			{
				$path .= '?width='.$width.'&amp;height='.$height; // this appends size requirements to facebook image
			}

			// request bigger photo from twitter
			if (stripos($path, 'twimg.com'))
			{

				if ($height > 75)
				{
					$path = str_replace('_normal', '_bigger', $path); // this forces _bigger 73x73 sized image (over default 48x48), no custom crop offered
				}
				if ($height < 25)
				{
					$path = str_replace('_normal', '_mini', $path); // this forces _mini 24x24 sized image (over default 48x48), no custom crop offered
				}
			}

		}

		if ($check && ! $remote)
		{
			if ( ! fileExists($path))
			{
				$title = "Photo not found! ";
				$path = site_url(RES_DIR.'/img/default-person.png');
			}
		}

	}
	else
	{
		$path = site_url(RES_DIR.'/img/default-person.png');
	}


	return '<img '.(($id) ? 'id="'.$id.'"' : '').' src="'.$path.'" height="'.$height.'" width="'.$width.'" title="'.$title.'" alt="'.$title.'" class="'.$class.'">';

}

/* Used for checking if a particular file exists (locally). Use sparingly as it is time consuming!
 *
 */
function fileExists($path)
{
	if (@fopen($path, "r") == TRUE)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}