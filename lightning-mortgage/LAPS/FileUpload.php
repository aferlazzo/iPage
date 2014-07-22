<HTML>

<BODY BGCOLOR=FFFFFF>
    <?php
        $uploadDir = '../cgi-bin/formdata/';
        if (isset($submit)){
            if ($upload != 'none'){
                $dest = $uploadDir . $upload_name;
                if (@copy($upload, $dest)){
                    echo "Successfully uploaded $dest<BR>\n";
                }
                else{
                    echo "<FONT COLOR=FF0000><B>File Upload Failed</B></FONT><BR>\n";
                    $perms = @fileperms($uploadDir);
                    $owner = @fileowner($uploadDir);
                    if (!$perms){
                        echo "Directory does not exist: $uploadDir<BR>\n";
                    }
                    else{
                        $myuid = getmyuid();
                        if (!($perms & 2) && !(($owner == $myuid) && ($perms & 128))){
                            echo get_current_user(), " doesn't have permission to write in $uploadDir<BR>\n";
                        }
                    }
                }
            }
            else{
                echo "<FONT COLOR=FF0000><B>File Upload Failed</B></FONT><BR>\n";
                echo "Filesize exceeds limit in FORM or php.ini<BR>\n";
            }
        }
    ?>

    <FORM ENCTYPE=multipart/form-data ACTION=fileupload.php METHOD=POST>
        <INPUT TYPE=HIDDEN NAME=MAX_FILE_SIZE VALUE=10000>
        Upload File: <INPUT NAME=upload TYPE=FILE><BR>
        <INPUT TYPE=SUBMIT NAME=submit VALUE="Upload">
    </FORM>
</BODY>
</HTML>