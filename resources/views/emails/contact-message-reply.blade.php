<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>رد على رسالتك</title>

</head>


<body style="
    margin:0;
    padding:0;
    background:#f6f3ea;
    font-family:Arial,Tahoma,sans-serif;
    direction:rtl;
">


<div style="
    max-width:680px;
    margin:40px auto;
    padding:0 20px;
">


    <div style="
        background:#ffffff;
        border-radius:18px;
        overflow:hidden;
        border:1px solid #e7e0d0;
    ">


        {{-- Header --}}

        <div style="
            padding:28px;
            background:#304437;
            color:#ffffff;
            text-align:center;
        ">

            <h1 style="
                margin:0;
                font-size:24px;
            ">
                رد على رسالتك
            </h1>


            <p style="
                margin:10px 0 0;
                opacity:.85;
                font-size:14px;
            ">
                Hebah Abdelwahab | Digital Solutions
            </p>

        </div>


        {{-- Content --}}

        <div style="
            padding:30px;
        ">


            <div style="
                margin-bottom:24px;
                color:#30352f;
                font-size:16px;
                line-height:1.9;
            ">

                مرحبًا
                <strong>
                    {{ $contactMessage->name }}
                </strong>،

                <br>

                شكرًا لتواصلك معي. يسعدني الرد على استفسارك.

            </div>


            {{-- Original Subject --}}

            <div style="
                margin-bottom:22px;
            ">

                <div style="
                    color:#8a806e;
                    font-size:13px;
                    margin-bottom:6px;
                ">
                    موضوع رسالتك
                </div>


                <div style="
                    font-size:16px;
                    font-weight:bold;
                    color:#30352f;
                ">

                    {{ $contactMessage->subject }}

                </div>

            </div>


            {{-- Original Message --}}

            <div style="
                margin-bottom:24px;
            ">

                <div style="
                    color:#8a806e;
                    font-size:13px;
                    margin-bottom:8px;
                ">
                    رسالتك
                </div>


                <div style="
                    background:#f8f6f0;
                    border:1px solid #ebe5d8;
                    border-radius:12px;
                    padding:18px;
                    color:#555a52;
                    line-height:1.9;
                    white-space:pre-line;
                ">

                    {{ $contactMessage->message }}

                </div>

            </div>


            {{-- Reply --}}

            <div style="
                margin-bottom:10px;
            ">

                <div style="
                    color:#8a806e;
                    font-size:13px;
                    margin-bottom:8px;
                ">
                    الرد
                </div>


                <div style="
                    background:#304437;
                    border-radius:12px;
                    padding:20px;
                    color:#ffffff;
                    line-height:1.9;
                    white-space:pre-line;
                ">

                    {{ $reply }}

                </div>

            </div>


        </div>


        {{-- Footer --}}

        <div style="
            padding:20px 30px;
            background:#faf9f5;
            border-top:1px solid #eee9df;
            color:#8a806e;
            font-size:12px;
            text-align:center;
        ">

            شكرًا لتواصلك مع Hebah Abdelwahab.

            <br>

            يمكنك الرد مباشرة على هذا البريد إذا كان لديك أي استفسار آخر.

        </div>


    </div>

</div>


</body>

</html>
