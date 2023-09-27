<?php
class imageutil{
    public static function convertImageJPG($originalImage, $outputImage, $quality=100){
        // Função que converte qualquer imagem em JPG
        $originalImage = TEMP_DIR.'/'.$originalImage;
        $outputImage   = TEMP_DIR.'/'.$outputImage;
        
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1]; 
        
        // jpg, png, gif or bmp?
        if (preg_match('/jpg|jpeg/i',$ext)){
            $imageTmp=imagecreatefromjpeg($originalImage);
        }else if (preg_match('/png/i',$ext)){
            $imageTmp=imagecreatefrompng($originalImage);
        }else if (preg_match('/gif/i',$ext)){
            $imageTmp=imagecreatefromgif($originalImage);
        }else if (preg_match('/bmp/i',$ext)){
            $imageTmp=imagecreatefrombmp($originalImage);
        }else{
            return false;
        }
        
        // Qualidade pode variar de 0 a 100
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return true;
    }
}
