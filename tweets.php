<?php
    session_start();
?>
<!DOCTYPE html>
<!-- mike@8bitgeek.net 01-2023 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Said What?</title>
</head>
<body>
    <a href="">Twitter Said What?<a>
    <br/><br/><br/>
    
    <form action="tweets.php">
        <table>
            <tr><td><label for="username">Twitter Handle:</label></td><td><input type="text" id="username" name="username" value=""></td></tr>
            <tr><td><label for="limit">Limit:</label></td><td><input type="number" id="limit" name="limit" min="1" max="1000" step="1" value="100"></td></tr>
            <tr><td><label for="query">Query:</label></td><td><input type="text" id="query" name="query" value=""></td></tr>
            <tr><td><label for="since">Since:</label></td><td><input type="date" id="since" name="since" value="2020-01-01"></td></tr>
            <tr><td><label for="until">Until:</label></td><td><input type="date" id="until" name="until" value="2022-01-01"></td></tr>
        <table>
        <input type="submit" value="Submit">
    </form> 

    <?php
        // This PHP code only runs when there is a GET request (e.g. form submit).
        if ( count($_GET) > 0 )
        {
            // ensure file operations are not in cache.
            clearstatcache();

            // output path is based on the session id string.
            $sid=session_id();
            $output_path='csv/' . $sid . '.csv';

            // convert the GET params to a json string
            $json_text = json_encode($_GET);  

            // write the json string to a tempo file 
            // and get the temp file path and file size
            $json_fd = tmpfile();
            $input_path = stream_get_meta_data($json_fd)['uri'];
            fwrite($json_fd, $json_text);
            $json_size = filesize($input_path);

            // debuging output
            if ( 1 )
            {
                fseek($json_fd, 0);
                fread($json_fd,$json_size);
            }

            // perform the syscall to run the python script
            $output=null;
            $retval=null;
            $cmd='./tweets -i ' . $input_path . ' -o ' . $output_path;
            $rc=exec( $cmd, $output, $retval );
            // handle the error condition
            if ( $retval != 0 )
            {
                echo '<br /><br />error #' . $retval . ': ' . $rc . '<br />';
            }

            // this removes the temporary file
            fclose($json_fd); 

            // collect the download file.
            if ( $retval == 0  )
            {
                echo '<br/><br/>Download <a href="' . $output_path . '">' . $output_path . '</a>';
            }
            else
            {
                echo '<br/><br/>A failure occured. No CSV (' . $output_path . ') was generated.';
            }

            // @TODO - clean out old download files...
        }
    ?>

    <br/><br/><br/>
    <hr/>
    <a href="https://github.com/8bitgeek/twitter-said-what" target="_blank">Fork Me</a>

</body>
</html>
