/*==================================================
                PROGRAMS DATA
==================================================*/

const academyProgramsData = [

    {

        title: "القرآن الكريم",

        icon: "fa-solid fa-book-quran",

        description:
            "برنامج متكامل لتحفيظ القرآن الكريم مع المراجعة المستمرة وتصحيح التلاوة، يناسب الأطفال والكبار ويُبنى وفق مستوى كل طالب.",

        features: [

            "خطة حفظ متدرجة",

            "مراجعة أسبوعية",

            "اختبارات دورية",

            "تصحيح التلاوة"

        ],

        duration: "6 أشهر",

        lessons: "48",

        level: "جميع المستويات",

        age: "جميع الأعمار"

    },

    {

        title: "التجويد",

        icon: "fa-solid fa-microphone-lines",

        description:
            "تعلم أحكام التجويد عمليًا مع تطبيق مباشر على التلاوة وإتقان المخارج والصفات حتى تصل إلى قراءة صحيحة ومتقنة.",

        features: [

            "مخارج الحروف",

            "أحكام النون والميم",

            "المدود",

            "تطبيق عملي"

        ],

        duration: "4 أشهر",

        lessons: "32",

        level: "مبتدئ - متوسط",

        age: "10 سنوات فأكثر"

    },

    {

        title: "اللغة العربية",

        icon: "fa-solid fa-language",

        description:
            "برنامج متكامل لتعليم اللغة العربية يشمل القراءة والكتابة والقواعد والمحادثة بطريقة تفاعلية وحديثة.",

        features: [

            "القراءة",

            "الكتابة",

            "النحو",

            "المحادثة"

        ],

        duration: "5 أشهر",

        lessons: "40",

        level: "جميع المستويات",

        age: "جميع الأعمار"

    }

];

/*==================================================
                PROGRAMS CLASS
==================================================*/

class AcademyPrograms {

    constructor() {

        this.current = 0;

    }

    /*==================================
                INIT
    ==================================*/

    init() {

        this.cacheDom();

        if (!this.title) return;

        this.bindEvents();

        this.updateProgram();

    }

    /*==================================
            CACHE DOM
    ==================================*/

    cacheDom() {

        this.tabs = document.querySelectorAll(

            ".academy-program-tab"

        );

        this.icon = document.getElementById("programIcon");

        this.title = document.getElementById("programTitle");

        this.description = document.getElementById("programDescription");

        this.features = document.getElementById("programFeatures");

        this.duration = document.getElementById("programDuration");

        this.lessons = document.getElementById("programLessons");

        this.level = document.getElementById("programLevel");

        this.age = document.getElementById("programAge");

        this.card = document.querySelector(

            ".academy-program-view"

        );

    }

    /*==================================
                EVENTS
    ==================================*/

    bindEvents() {

        this.tabs.forEach((tab,index)=>{

            tab.addEventListener("click",()=>{

                this.changeProgram(index);

            });

        });

    }
        /*==================================
            UPDATE PROGRAM
    ==================================*/

    updateProgram() {

        const program = academyProgramsData[this.current];

        /*----------- Card Animation -----------*/

        if (this.card) {

            this.card.style.opacity = "0";

            this.card.style.transform = "translateY(20px)";

        }

        setTimeout(() => {

            /*----------- Icon -----------*/

            this.icon.className = program.icon;

            /*----------- Title -----------*/

            this.title.textContent = program.title;

            /*----------- Description -----------*/

            this.description.textContent = program.description;

            /*----------- Features -----------*/

            this.features.innerHTML = "";

            program.features.forEach(feature => {

                this.features.innerHTML += `

                    <div>

                        <i class="fa-solid fa-check"></i>

                        <span>${feature}</span>

                    </div>

                `;

            });

            /*----------- Details -----------*/

            this.duration.textContent = program.duration;

            this.lessons.textContent = program.lessons;

            this.level.textContent = program.level;

            this.age.textContent = program.age;

            /*----------- Active Tab -----------*/

            this.tabs.forEach((tab,index)=>{

                tab.classList.toggle(

                    "active",

                    index===this.current

                );

            });

            /*----------- Show Card -----------*/

            if (this.card) {

                this.card.style.opacity = "1";

                this.card.style.transform = "translateY(0)";

            }

        },180);

    }

    /*==================================
            CHANGE PROGRAM
    ==================================*/

    changeProgram(index) {

        if(index===this.current) return;

        this.current=index;

        this.updateProgram();

    }

}

/*==================================================
            EXPORT GLOBAL
==================================================*/

window.AcademyPrograms = AcademyPrograms;
