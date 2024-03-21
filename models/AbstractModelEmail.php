<?php
/**
 * AbstractModelEmail Class
 * A generic representation mail.
*/
abstract class AbstractModelEmail
{
    protected $infoMail = '';
    protected $title = '';
    protected $body = '';
    protected $subject = '';
    protected $emailTo = '';
    protected $emailFrom = '';
    protected $path = '';

    function makeMeta()
    {
        global $param_protocole;
        global $param_server_principal_domaine;
        global $param_title;
        global $param_racine;
        global $param_description;
        global $param_keyword;
        global $param_cache;
        global $param_revisit;
        global $param_copyright;
        global $param_indexation;
        global $param_auteur;
        global $param_lang;

        $make = '<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="identifier-url" content="'.$param_protocole.'://'.$param_server_principal_domaine.$param_racine.'" />
        <meta name="title" content="'.$param_title.'" />
        <meta name="description" content="'.$param_description.'" />
        <meta name="abstract" content="'.$param_description.'" />
        <meta name="keywords" content="'.$param_keyword.'" />
        <meta name="author" content="'.$param_auteur.'" />
        <meta name="generator" content="RunFaction" />
        <meta name="publisher" content="RunFaction" />';

        if ($param_cache == true)
        {
            $make .= '<meta http-equiv="pragma" content="no-cache" />';
        }

        $make .= '<meta name="revisit-after" content="'.$param_revisit.'" />
        <meta name="language" content="'.strtoupper($param_lang).'" />
        <meta name="copyright" content="'.$param_copyright.'" />
        <meta name="robots" content="'.$param_indexation.'" />';
        
        return $make;
    }

    public function __construct() 
    {    
        $this->infoMail = '<p>Ceci est un email automatique, merci de ne pas y r&#233;pondre.</p>';
        $this->path = BASEPATH;
    }
    
    public function send($emailTo,$emailFrom)
    {   
        global $param_title;
        
        $this->emailTo = $emailTo;
        $this->emailFrom = $emailFrom;
        
        $make = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="https://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
        '.self::makeMeta().'
        <style type="text/css">
        body {
        margin: 0 !important;
        padding: 0 !important;
        -webkit-text-size-adjust: 100% !important;
        -ms-text-size-adjust: 100% !important;
        -webkit-font-smoothing: antialiased !important;
        }
        img {
        border: 0 !important;
        outline: none !important;
        }
        p {
        Margin: 0px !important;
        Padding: 0px !important;
        }
        table {
        border-collapse: collapse;
        mso-table-lspace: 0px;
        mso-table-rspace: 0px;
        }
        td, a, span {
        border-collapse: collapse;
        mso-line-height-rule: exactly;
        }
        .ExternalClass * {
        line-height: 100%;
        }
        .em_defaultlink a {
        color: inherit !important;
        text-decoration: none !important;
        }
        span.MsoHyperlink {
        mso-style-priority: 99;
        color: inherit;
        }
        span.MsoHyperlinkFollowed {
        mso-style-priority: 99;
        color: inherit;
        }
        @media only screen and (min-width:481px) and (max-width:699px) {
        .em_main_table {
        width: 100% !important;
        }
        .em_wrapper {
        width: 100% !important;
        }
        .em_hide {
        display: none !important;
        }
        .em_img {
        width: 100% !important;
        height: auto !important;
        }
        .em_h20 {
        height: 20px !important;
        }
        .em_padd {
        padding: 20px 10px !important;
        }
        }
        @media screen and (max-width: 480px) {
        .em_main_table {
        width: 100% !important;
        }
        .em_wrapper {
        width: 100% !important;
        }
        .em_hide {
        display: none !important;
        }
        .em_img {
        width: 100% !important;
        height: auto !important;
        }
        .em_h20 {
        height: 20px !important;
        }
        .em_padd {
        padding: 20px 10px !important;
        }
        .em_text1 {
        font-size: 16px !important;
        line-height: 24px !important;
        }
        u + .em_body .em_full_wrap {
        width: 100% !important;
        width: 100vw !important;
        }
        }
        </style>
        </head>

        <body class="em_body" style="margin:0px; padding:0px;" bgcolor="#efefef">
        <table class="em_full_wrap" valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
        <tbody>
        <tr>
        <td valign="top" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
        <td valign="top" align="center"><img class="em_img" alt="Run Faction" style="display:block; font-family:Arial, sans-serif; font-size:30px; line-height:34px; color:#000000; max-width:1200px;" src="'.$this->path.'assets/dist/img/fond.png" width="1201" border="0" height="373"></td>
        </tr>
        </tbody></table></td>
        </tr>

        <tr>
        <td style="padding:35px 70px 30px;" class="em_padd" valign="top" bgcolor="#f6f7f8" align="center">
        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
        <td style="font-size:24px; line-height:30px; " valign="top" align="center">'.$this->title.'</td>
        </tr>
        <tr>
        <td style="font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
        </tr>
        <tr>
        <td style="font-size:18px; line-height:22px; letter-spacing:2px; padding-bottom:12px;" valign="top" align="center">'.$this->body.'</td>
        </tr>

        </tbody></table></td>
        </tr>

        <!—//Content Text Section–>
        <!—Footer Section—>
        <tr>
        <td class="em_padd" valign="top" bgcolor="#f6f7f8" align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody>
        <tr>
        <td style="font-family:’Open Sans’, Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;" valign="top" align="center">
         <a href="'.$this->path.'declconfidentialite.php" target="_blank" style="color:#999999; text-decoration:underline;">Déclaration de confidentialité</a> | <a href="'.$this->path.'cgucgv.php" target="_blank" style="color:#999999; text-decoration:underline;">Conditions générales d\'utilisation</a> | <a href="'.$this->path.'mentionslegales.php" target="_blank" style="color:#999999; text-decoration:underline;">Mentions légales</a><br>
        © <script>document.write(new Date().getFullYear())</script> Run Faction <br>
        '.$this->infoMail.'</td>
        </tr>
        </tbody></table></td>
        </tr>
        <tr>
        <td class="em_hide" style="line-height:1px;min-width:700px;background-color:#ffffff;"><img src="'.$this->path.'assets/dist/img/spacer.gif" alt="" style="max-height:1px; min-height:1px; display:block; width:700px; min-width:700px;" width="700" border="0" height="1"></td>
        </tr>
        </tbody></table></td>
        </tr>
        </tbody></table>
        <div class="em_hide" style="white-space: nowrap; display: none; font-size:0px; line-height:0px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
        </body></html>';

        send_mail($this->emailTo, $this->emailFrom,$this->subject,$make);
    }
}
?>