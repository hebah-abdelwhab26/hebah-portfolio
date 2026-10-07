document.addEventListener('DOMContentLoaded', function () {


/*
|--------------------------------------------------------------------------
| ELEMENTS
|--------------------------------------------------------------------------
*/

const bookingTypeButtons =
    document.querySelectorAll(
        '.education-booking-type'
    );

const timeButtons =
    document.querySelectorAll(
        '.education-booking-time'
    );

const bookingTypeInput =
    document.getElementById(
        'selected-booking-type-id'
    );

const bookingTypeGetInput =
    document.getElementById(
        'education-booking-type-input'
    );

const selectedBookingTypeText =
    document.getElementById(
        'selected-booking-type-text'
    );

const selectedBookingTypeDetails =
    document.getElementById(
        'selected-booking-type-details'
    );

const selectedStartTime =
    document.getElementById(
        'selected-start-time'
    );

const selectedEndTime =
    document.getElementById(
        'selected-end-time'
    );

const selectedTimeText =
    document.getElementById(
        'selected-time-text'
    );

const bookingSubmit =
    document.getElementById(
        'education-booking-submit'
    );

const datePickerButton =
    document.getElementById(
        'education-date-picker'
    );

const dateInput =
    document.getElementById(
        'education-booking-date'
    );

const selectedDateText =
    document.getElementById(
        'education-selected-date'
    );

const selectedDateFull =
    document.getElementById(
        'education-selected-date-full'
    );

const dateForm =
    document.getElementById(
        'education-date-form'
    );


/*
|--------------------------------------------------------------------------
| INITIAL STATE
|--------------------------------------------------------------------------
*/

if (bookingSubmit) {
    bookingSubmit.disabled = true;
}


/*
|--------------------------------------------------------------------------
| BOOKING TYPE
|--------------------------------------------------------------------------
*/

bookingTypeButtons.forEach(function (button) {

    button.addEventListener(
        'click',
        function () {

            /*
            |--------------------------------------------------------------
            | REMOVE PREVIOUS SELECTION
            |--------------------------------------------------------------
            */

            bookingTypeButtons.forEach(
                function (item) {

                    item.classList.remove(
                        'selected'
                    );

                }
            );


            /*
            |--------------------------------------------------------------
            | SELECT CURRENT TYPE
            |--------------------------------------------------------------
            */

            button.classList.add(
                'selected'
            );


            /*
            |--------------------------------------------------------------
            | DATA
            |--------------------------------------------------------------
            */

            const id =
                button.dataset.bookingTypeId;

            const name =
                button.dataset.bookingTypeName;

            const description =
                button.dataset.bookingTypeDescription;

            const sessions =
                button.dataset.bookingTypeSessions;

            const price =
                button.dataset.bookingTypePrice;

            const currency =
                button.dataset.bookingTypeCurrency ||
                'SAR';


            /*
            |--------------------------------------------------------------
            | HIDDEN INPUTS
            |--------------------------------------------------------------
            */

            if (bookingTypeInput) {

                bookingTypeInput.value =
                    id;
            }


            if (bookingTypeGetInput) {

                bookingTypeGetInput.value =
                    id;
            }


            /*
            |--------------------------------------------------------------
            | SUMMARY
            |--------------------------------------------------------------
            */

            if (selectedBookingTypeText) {

                selectedBookingTypeText.textContent =
                    name;
            }


            if (selectedBookingTypeDetails) {

                let details = '';


                if (sessions) {

                    details +=
                        sessions +
                        ' حصص';
                }


                if (price) {

                    if (details) {
                        details += ' — ';
                    }

                    details +=
                        currency +
                        ' ' +
                        Number(price).toFixed(2);
                }


                if (!details && description) {

                    details =
                        description;
                }


                selectedBookingTypeDetails.textContent =
                    details || '-';
            }


            /*
            |--------------------------------------------------------------
            | ENABLE SUBMIT ONLY WHEN TIME EXISTS
            |--------------------------------------------------------------
            */

            updateSubmitState();


            /*
            |--------------------------------------------------------------
            | IF DATE EXISTS
            |--------------------------------------------------------------
            |
            | لا نرسل النموذج مباشرة حتى لا يفقد المستخدم الاختيار
            | في حال كانت الصفحة تحتوي بالفعل على الأوقات.
            |
            */

        }
    );

});


/*
|--------------------------------------------------------------------------
| TIME SELECTION
|--------------------------------------------------------------------------
*/

timeButtons.forEach(function (button) {

    button.addEventListener(
        'click',
        function () {

            /*
            |--------------------------------------------------------------
            | REMOVE PREVIOUS SELECTION
            |--------------------------------------------------------------
            */

            timeButtons.forEach(
                function (item) {

                    item.classList.remove(
                        'selected'
                    );

                }
            );


            /*
            |--------------------------------------------------------------
            | SELECT CURRENT TIME
            |--------------------------------------------------------------
            */

            button.classList.add(
                'selected'
            );


            /*
            |--------------------------------------------------------------
            | DATA
            |--------------------------------------------------------------
            */

            const start =
                button.dataset.start;

            const end =
                button.dataset.end;


            /*
            |--------------------------------------------------------------
            | HIDDEN VALUES
            |--------------------------------------------------------------
            */

            if (selectedStartTime) {

                selectedStartTime.value =
                    start;
            }


            if (selectedEndTime) {

                selectedEndTime.value =
                    end;
            }


            /*
            |--------------------------------------------------------------
            | SUMMARY
            |--------------------------------------------------------------
            */

            if (selectedTimeText) {

                selectedTimeText.textContent =
                    start +
                    ' - ' +
                    end;
            }


            /*
            |--------------------------------------------------------------
            | SUBMIT
            |--------------------------------------------------------------
            */

            updateSubmitState();


            /*
            |--------------------------------------------------------------
            | SCROLL TO FORM
            |--------------------------------------------------------------
            */

            const formCard =
                document.getElementById(
                    'education-booking-form-card'
                );


            if (formCard) {

                setTimeout(
                    function () {

                        formCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                    },
                    100
                );
            }

        }
    );

});


/*
|--------------------------------------------------------------------------
| DATE PICKER
|--------------------------------------------------------------------------
*/

if (
    datePickerButton &&
    dateInput
) {

    datePickerButton.addEventListener(
        'click',
        function () {

            if (
                typeof dateInput.showPicker ===
                'function'
            ) {

                dateInput.showPicker();

            } else {

                dateInput.focus();
                dateInput.click();
            }

        }
    );


    dateInput.addEventListener(
        'change',
        function () {

            if (!this.value) {
                return;
            }


            /*
            |--------------------------------------------------------------
            | UPDATE DATE DISPLAY
            |--------------------------------------------------------------
            */

            updateDateDisplay(
                this.value
            );


            /*
            |--------------------------------------------------------------
            | SUBMIT GET FORM
            |--------------------------------------------------------------
            |
            | الاحتفاظ بنوع الحجز أثناء الانتقال للتاريخ.
            |
            */

            if (dateForm) {

                dateForm.submit();
            }

        }
    );

}


/*
|--------------------------------------------------------------------------
| DATE DISPLAY
|--------------------------------------------------------------------------
*/

function updateDateDisplay(
    value
) {

    const date =
        new Date(
            value + 'T00:00:00'
        );


    if (
        Number.isNaN(
            date.getTime()
        )
    ) {
        return;
    }


    if (selectedDateText) {

        selectedDateText.textContent =
            new Intl.DateTimeFormat(
                'ar-SA',
                {
                    weekday: 'long'
                }
            ).format(date);
    }


    if (selectedDateFull) {

        selectedDateFull.textContent =
            new Intl.DateTimeFormat(
                'ar-SA',
                {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                }
            ).format(date);
    }

}


/*
|--------------------------------------------------------------------------
| SUBMIT STATE
|--------------------------------------------------------------------------
*/

function updateSubmitState() {

    if (!bookingSubmit) {
        return;
    }


    const hasType =
        bookingTypeInput &&
        bookingTypeInput.value;


    const hasTime =
        selectedStartTime &&
        selectedStartTime.value &&
        selectedEndTime &&
        selectedEndTime.value;


    bookingSubmit.disabled =
        !hasType ||
        !hasTime;

}


/*
|--------------------------------------------------------------------------
| RESTORE BOOKING TYPE FROM QUERY
|--------------------------------------------------------------------------
*/

if (
    bookingTypeGetInput &&
    bookingTypeGetInput.value
) {

    const selectedId =
        String(
            bookingTypeGetInput.value
        );


    bookingTypeButtons.forEach(
        function (button) {

            if (
                String(
                    button.dataset.bookingTypeId
                ) === selectedId
            ) {

                button.classList.add(
                    'selected'
                );


                if (bookingTypeInput) {

                    bookingTypeInput.value =
                        selectedId;
                }


                if (selectedBookingTypeText) {

                    selectedBookingTypeText.textContent =
                        button.dataset.bookingTypeName ||
                        'نوع الحجز';
                }


                if (selectedBookingTypeDetails) {

                    const sessions =
                        button.dataset.bookingTypeSessions;

                    const price =
                        button.dataset.bookingTypePrice;

                    const currency =
                        button.dataset.bookingTypeCurrency ||
                        'SAR';

                    let details = '';


                    if (sessions) {

                        details +=
                            sessions +
                            ' حصص';
                    }


                    if (price) {

                        if (details) {
                            details += ' — ';
                        }

                        details +=
                            currency +
                            ' ' +
                            Number(price).toFixed(2);
                    }


                    selectedBookingTypeDetails.textContent =
                        details || '-';
                }

            }

        }
    );

}


/*
|--------------------------------------------------------------------------
| RESTORE DATE DISPLAY
|--------------------------------------------------------------------------
*/

if (
    dateInput &&
    dateInput.value
) {

    updateDateDisplay(
        dateInput.value
    );
}


/*
|--------------------------------------------------------------------------
| FORM VALIDATION
|--------------------------------------------------------------------------
*/

const bookingForm =
    document.getElementById(
        'education-booking-form'
    );


if (bookingForm) {

    bookingForm.addEventListener(
        'submit',
        function (event) {

            const hasType =
                bookingTypeInput &&
                bookingTypeInput.value;


            const hasTime =
                selectedStartTime &&
                selectedStartTime.value &&
                selectedEndTime &&
                selectedEndTime.value;


            if (!hasType) {

                event.preventDefault();

                alert(
                    'يرجى اختيار نوع الحجز.'
                );

                return;
            }


            if (!hasTime) {

                event.preventDefault();

                alert(
                    'يرجى اختيار الموعد.'
                );

                return;
            }

        }
    );

}


});
