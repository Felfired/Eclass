<?php
    function Encryption($Data)
    { 
        $hash = password_hash($Data, PASSWORD_DEFAULT);
        return $hash;
    }
    function Decryption($Data, $Hash)
    {
        if (password_verify($Data, $Hash)) 
        {
            return "Let me in, I'm genuine!";
        }
    }
?>