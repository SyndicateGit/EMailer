<?php

final class http_utils
{
    public static function get_site_base_url()
    {
        global $CFG;

        $retval = $CFG->base_url;

        # Suffix base_url with a '/' if needed...
        if (strlen($retval) > 0
            && $retval[strlen($retval)-1] != '/')
        {
            $retval .= '/';
        }

        # and return it as a string...
        return $retval;
    }

    public static function build_full_url($uri)
    {
        return $retval = self::get_site_base_url().$uri;
    }

    //-----

    //
    // NOTE: A "full_url" assumes the $url argument contains the
    //       HTTP protocol, server name, etc.
    //

    public static function redirect_full_url($url, $http_status)
    {
        header('Location: '.$url, true, $http_status);
        exit();
    }

    public static function temporary_redirect_full_url($url)
    {
        self::redirect_full_url($url,302);
        exit();
    }

    public static function permanent_redirect_full_url($url)
    {
        self::redirect_full_url($url,301);
        exit();
    }

    public static function other_redirect_full_url($url)
    {
        self::redirect_full_url($url,303);
        exit();
    }
    
    //-----

    //
    // NOTE: A non-"full" url assumes the $url argument is relative
    //       to content on this site and does not have in it the
    //       HTTP protocol, server name, etc. Such $url strings will
    //       get converted into a full URL string containing this
    //       site's name, etc.
    //

    public static function redirect_url($url, $http_status)
    {
        header('Location: '.self::get_site_base_url().$url, true, $http_status);
        exit();
    }

    public static function temporary_redirect_url($url)
    {
        self::redirect_url($url,302);
        exit();
    }

    public static function permanent_redirect_url($url)
    {
        self::redirect_url($url,301);
        exit();
    }

    public static function other_redirect_url($url)
    {
        self::redirect_url($url,303);
        exit();
    }

    //-----

    public static function get_client_ip_address()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    //-----

    //
    // sendFile($lfn,$rfn,$mime,$desc,$clean)
    //
    // Function to send the server (local) file $lfn to a web client
    // telling the web client the file name is $rfn, has MIME type
    // $mime, having a short description $desc, and optionally
    // invoke a special cleanup() function $clean when it is done sending
    // it.
    //
    // The $clean function, if set, must be a function taking two
    // arguments:
    //
    //   1) the local file name, and,
    //   2) the returned value from readfile()
    //   3) a $status value
    //      - is 200 if file completely sent
    //      - is 404 if file doesn't exist (404 header sent)
    //      - is 403 if file doesn't have read perms (403 header sent)
    //      - is 0 otherwise
    //
    // If $clean is set to any value other than null, then it is always
    // called.
    //
    // It is assumed that $localFileName is valid.
    //
    // NOTE: sendFile() does not return! Use $cleanUpAction if needed!

    public static function sendFile($localFileName, $asRemoteFileName,
        $mimeType, $desc, $cleanUpFunc=null)
    {
        // Turn off server-side auto compression if it is present...
        @apache_setenv('no-gzip', 1);
        @ini_set('zlib.output_compression', 0);

        $okay = TRUE;
        $status = 200;
        $result = FALSE;

        if (!is_file($localFileName))
        {
            header('HTTP/1.0 404 Not Found');
            $okay = FALSE;
            $status = 404;
        }

        if ($okay === TRUE && !is_readable($localFileName))
        {
            header('HTTP/1.0 403 Forbidden');
            $okay = FALSE;
            $status = 403;
        }

        if ($okay == TRUE)
        {
            // Set the headers...
            header('Pragma: public');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // some day in the past
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Cache-Control: private",false); // required for certain browsers
            header('Last-Modified: '.gmdate('D, d M Y H:i:s',
                filemtime($localFileName)).' GMT');

            if ($desc !== null)
                header('Content-Description: '.$desc);

            if ($mimeType !== null)
                header('Content-Type: '.$mimeType);
            else
                header('Content-Type: application/octet-stream');

            if ($asRemoteFileName == null)
                header('Content-Disposition: attachment');
            else
                header('Content-Disposition: attachment; filename="'.$asRemoteFileName.'"');

            header('Content-Transfer-Encoding: binary');

            $len = filesize($localFileName);
            header('Content-Length: '.$len);

            flush();
            ob_clean();
            ob_end_flush();

            // Send the file...
            $result = @readfile($localFileName);

            if ($result === FALSE || $result !== $len)
            {
                $okay = FALSE;
                $status = 0;
            }
        }

        if ($cleanUpFunc !== null)
            @call_user_func($cleanUpFunc, $localFileName, $result, $status);

        exit();
    }
}

?>
