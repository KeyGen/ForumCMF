<?php

$emailUser = getUserUniversal($name,'email');

echo "

<center>
<table style='width: 100%;'>
    <tr><td style='height: 14px;'></td></tr>
    <tr>
        <td style='height: 30px; color: #ffffff; text-align: center; font-weight: bold; border-radius: 6px;' class='borderColor' colspan='3'>
            Редактирование пароля и email $name
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr>
    <tr>
        <td colspan='3'>
            <fieldset>
            <legend>Изменить пароль</legend>
                <table style='width: 100%'>
                    <tr>
                        <td style='width: 250px;'>
                            Введите старый пароль
                        </td>
                        <td>
                            <input id='inputEditorPassword1' style='height: 30px; width: 100%;' maxlength='20' type='password' value=''
                            onchange=\"testPasswordUser('$name', this.value);\" />
                        </td>
                        <td style='width: 350px;'>
                            <img id='iconPasswordEditYes1' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                            <img id='iconPasswordEditNo1' class='none' width='20px' src='css/forumStyle/images/no.png'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Введите новый пароль
                        </td>
                        <td>
                            <input id='inputEditorPassword2' style='height: 30px; width: 100%;' maxlength='20' type='text' value=''
                            onchange=\"testPasswordUpdate(this.value,
                                                          document.getElementById('iconPasswordEditYes2'),
                                                          document.getElementById('iconPasswordEditNo2'));
                                       testControlPasswordUpdate(this.value, document.getElementById('inputEditorPassword3').value);\" />
                        </td>
                        <td>
                            <img id='iconPasswordEditYes2' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                            <img id='iconPasswordEditNo2' class='none' width='20px' src='css/forumStyle/images/no.png'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Поддвердите новый пароль
                        </td>
                        <td>
                            <input id='inputEditorPassword3' style='height: 30px; width: 100%;' maxlength='20' type='text' value=''
                            onchange=\"testControlPasswordUpdate(document.getElementById('inputEditorPassword2').value, this.value);\" />
                        </td>
                        <td>
                            <img id='iconPasswordEditYes3' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                            <img id='iconPasswordEditNo3' class='none' width='20px' src='css/forumStyle/images/no.png'>
                        </td>
                    </tr>
                    <tr><td style='height: 5px;'></td></tr>
                    <tr>
                        <td></td>
                        <td style='text-align: right;'>
                            <button id='buttonEditorPassword' style='height: 30px; width: 150px; font-size: 14px; text-align: center;'
                            onclick=\"setNewPasswordUser('$name', document.getElementById('inputEditorPassword3').value);\">Изменить</button>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
                <legend>Востановление пароля</legend>
                <table>
                    <tr>
                        <td style='text-align: right;'>
                            <!-- Диалог -->
                            <div id='dialog-message' title='Изменение пароля' class='none'>
                                <p>
                                  <span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>
                                  Будет создан новый пароль и отправлен вам на почту?<br><br>Выполнить?
                                </p>
                            </div>
                            <!-- Диалог -->
                            <button id='buttonPasswordToEmail' style='height: 30px; width: 300px; font-size: 14px; text-align: center;'
                            onclick=\"shwoDialogReconstructionPassword('$name');\">Выслать новый пароль на почту</button>
                        </td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
            <legend>Изменить email</legend>
                <table style='width: 100%'>
                    <tr>
                        <td style='width: 250px;'>
                        Ваш email
                        </td>
                        <td>
                        <div id='emailUserShow'>$emailUser</div>
                        </td>
                    </tr>
                    <tr><td style='height: 10px;'></td></tr>
                    <tr>
                        <td>
                            Введите новый email
                        </td>
                        <td>
                            <input id='inputEditorEmail1' style='height: 30px; width: 100%;' maxlength='20' type='text' value=''
                            onchange=\"testEmailEdit(this.value);\"/>
                        </td>
                        <td style='width: 350px;'>
                            <img id='iconEmailEditYes1' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                            <img id='iconEmailEditNo1' class='none' width='20px' src='css/forumStyle/images/no.png'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Подтвердите новый email
                        </td>
                        <td>
                            <input id='inputEditorEmail2' style='height: 30px; width: 100%;' maxlength='20' type='text' value=''
                            onchange=\"testControlEmailUpdate(document.getElementById('inputEditorEmail1').value, this.value);\" />
                        </td>
                        <td>
                            <img id='iconEmailEditYes2' class='none' width='20px' src='css/forumStyle/images/yes.png'>
                            <img id='iconEmailEditNo2' class='none' width='20px' src='css/forumStyle/images/no.png'>
                        </td>
                    </tr>
                    <tr><td style='height: 5px;'></td></tr>
                    <tr>
                        <td></td>
                        <td style='text-align: right;'>
                            <button id='buttonEditorEmail' style='height: 30px; width: 150px; font-size: 14px; text-align: center;' onclick=\"setNewEmailUser('$name',document.getElementById('inputEditorEmail1').value);\">Изменить</button>
                        </td>
                        <td></td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr><td style='height: 5px;'></td></tr>
    <tr><td style='height: 10px;  border-radius: 6px;' class='borderColor' colspan='3'></td></tr>
    <tr><td style='height: 14px;'></td></tr>
</table>
</center>
";