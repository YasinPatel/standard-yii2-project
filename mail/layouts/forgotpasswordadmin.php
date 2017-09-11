<?php
       use yii\helpers\Url;
?>
<?php include_once('header.php');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 15pt 0in 0in 0in;font-size: 11.5pt;color: #727882;background:white;font-family: Arial,Helvetica,sans-serif;line-height: 25px;padding: 0 20pt;">
    <tbody>
        <tr>
            <td style="padding: 10pt 0in 5pt 0in;" colspan="2">
                <span style="font-size:18px;font-weight:bold;color: #2a3940;">Dear <?php echo ucwords($username)?>,</span>
            </td>
        </tr>
        <tr>
            <td style="padding: 10pt 0in 0in 0in;">
                <span>You have requested for forgot password.</span>
            </td>
        </tr>
        <tr>
            <td style="padding: 10pt 0in 0in 0in;">
                <span>Please use the following link to reset your password:</span>
                <a href="<?=$link;?>" target="_blank" style="color: #d5af6e;"><?=$link;?></a>
            </td>
        </tr>

    </tbody>
</table>
<?php include_once('footer.php');?>
