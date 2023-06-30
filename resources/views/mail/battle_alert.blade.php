<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Welcome to UBattle!</title>
</head>
<body>
<table class="main" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="content-wrap" style="padding-bottom: 30px">
            <table style="width: max-content; margin: 0 auto; padding-bottom: 10px;" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="content-block" style="text-align:center;color: #FABA01; font-weight: bold;font-size: 20px;padding-bottom: 5px">
                        Welcome to UBattle!
                    </td>
                </tr>
                <tr style="text-align:center">
                    <td class="content-block" style="font-size: 18px;">The battle {{$data['title']}} has started </td>
                </tr>
                <tr style="text-align:center">
                    <td class="content-block" style="font-size: 18px;">Click the button below to join the battle</td>
                </tr>

            </table>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="content-block" style="text-align:center;">
                        <a style="font-size: 18px;
                                  color: white;
                                  padding: 7px 19px;
                                  border: none;
                                  border-radius: 5px;
                                  font-weight: bold;
                                  width: 210px;
                                  background-color: #3795FC;
                                  text-decoration: none;"
                            href="{{route('battle.show',$data['id'])}}">join</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
