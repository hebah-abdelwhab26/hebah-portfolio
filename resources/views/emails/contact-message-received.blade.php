
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <title>رسالة اتصال جديدة</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background: #f6f3ea;
    font-family: Arial, Tahoma, sans-serif;
    direction: rtl;
">

<div style="
    max-width: 680px;
    margin: 40px auto;
    padding: 0 20px;
">

    <div style="
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #e7e0d0;
    ">

        {{-- Header --}}
        <div style="
            padding: 28px;
            background: #304437;
            color: #ffffff;
            text-align: center;
        ">

            <h1 style="
                margin: 0;
                font-size: 24px;
            ">
                رسالة اتصال جديدة
            </h1>

            <p style="
                margin: 10px 0 0;
                opacity: 0.85;
                font-size: 14px;
            ">
                تم استلام رسالة جديدة من نموذج الاتصال
            </p>

        </div>


        {{-- Content --}}
        <div style="
            padding: 30px;
        ">

            <div style="margin-bottom: 22px;">

                <div style="
                    color: #8a806e;
                    font-size: 13px;
                    margin-bottom: 6px;
                ">
                    الاسم
                </div>

                <div style="
                    font-size: 17px;
                    font-weight: bold;
                    color: #30352f;
                ">
                    {{ $contactMessage->name }}
                </div>

            </div>


            <div style="margin-bottom: 22px;">

                <div style="
                    color: #8a806e;
                    font-size: 13px;
                    margin-bottom: 6px;
                ">
                    البريد الإلكتروني
                </div>

                <div style="
                    font-size: 16px;
                    color: #30352f;
                    direction: ltr;
                    text-align: right;
                ">
                    {{ $contactMessage->email }}
                </div>

            </div>


            <div style="margin-bottom: 22px;">

                <div style="
                    color: #8a806e;
                    font-size: 13px;
                    margin-bottom: 6px;
                ">
                    نوع الاستفسار
                </div>

                <div style="
                    font-size: 16px;
                    color: #30352f;
                ">
                    {{ $contactMessage->subject }}
                </div>

            </div>


            <div style="margin-bottom: 10px;">

                <div style="
                    color: #8a806e;
                    font-size: 13px;
                    margin-bottom: 8px;
                ">
                    الرسالة
                </div>

                <div style="
                    background: #f8f6f0;
                    border: 1px solid #ebe5d8;
                    border-radius: 12px;
                    padding: 18px;
                    color: #30352f;
                    line-height: 1.9;
                    white-space: pre-line;
                ">
                    {{ $contactMessage->message }}
                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div style="
            padding: 20px 30px;
            background: #faf9f5;
            border-top: 1px solid #eee9df;
            color: #8a806e;
            font-size: 12px;
            text-align: center;
        ">

            تم إرسال هذه الرسالة من نموذج الاتصال في الموقع.

        </div>

    </div>

</div>

</body>
</html>

