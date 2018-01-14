<tr>
    <td align="center" valign="top" style="padding-top:30px;padding-bottom:30px">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ffffff;border-collapse:separate!important;border-radius:4px">
            <tbody> 
                <tr>
                    <td align="center" valign="top"  style="color:#606060;font-family:Helvetica,Arial,sans-serif; font-size:15px;line-height:150%;padding-top:40px;padding-right:40px;padding-bottom:30px;padding-left:40px;text-align:center">
                        <h3 style="color:#606060!important;  font-family:Helvetica,Arial,sans-serif;      font-size:18px;letter-spacing:-.5px;line-height:115%; margin:0;padding:0;text-align:center">
                            <?php echo $userName; ?></h3>
                        <br />
                        <h1 style="color:#606060!important;  font-family:Helvetica,Arial,sans-serif;font-size:40px; font-weight:bold;letter-spacing:-1px;line-height:115%; margin:0;padding:0;text-align:center"> 
                            <?php echo $oneMoreStep; ?></h1>
 
                        <br />

                        <?php echo $instructions; ?><br /><br />
                        <p>Login:
                        <?php echo $login; ?> </p>
                        <p>Senha temporária: 
                        <?php echo $password; ?></p>


                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle"   style="padding-right:40px;padding-bottom:40px;padding-left:40px">
                        <table border="0" cellpadding="0"   cellspacing="0" style="background-color:#AFE4E2;  border-collapse:separate!important;border-radius:3px">
                            <tbody>
                                <tr>
                                    <td align="center" valign="middle"   style="color:#ffffff;
                                        font-family:Helvetica,Arial,sans-serif;
                                        font-size:15px;font-weight:bold; 
                                        line-height:100%;padding-top:18px;
                                        padding-right:15px;padding-bottom:15px;
                                        padding-left:15px">
                                        <a href="<?php echo 'https://echopractice.com/ep/users/resetPassword?userId=' . $userId; ?>" 
                                           style="color:#ffffff;text-decoration:none" target="_blank">
                                            <?php echo $activate_account; ?></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr> 
            </tbody>
        </table>
    </td>
</tr>