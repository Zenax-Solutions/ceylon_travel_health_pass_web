<style>
    .goog-te-gadget img {
        display: none !important;
    }

    body>.skiptranslate {
        display: none;
    }

    body {
        top: 0px !important;
    }

    #gb-widget-1498 {
        bottom: 162px !important;
        right: 45px !important;
    }

    .sc-1au8ryl-0 svg {
        visibility: hidden !important;
    }

    .jWcIXO {
        background-color: rgb(52 215 44) !important;
    }



    #1.container {
        display: none;
    }


    .goog-logo-link,
    .goog-te-gadget span {

        display: none !important;

    }

    .goog-te-gadget {

        color: transparent !important;
        font-size: 0;

    }

    #google_translate_element select {
        background: #f6edfd;
        color: #383ffa;
        border: none;
        border-radius: 3px;
        padding: 6px 8px
    }

    .goog-logo-link {
        display: none !important;
    }

    .goog-te-gadget {
        color: transparent !important;
    }

    .goog-te-banner-frame {
        display: none !important;
    }

    #goog-gt-tt,
    .goog-te-balloon-frame {
        display: none !important;
    }

    .goog-text-highlight {
        background: none !important;
        box-shadow: none !important;
    }

    #google_translate_element_1 select {
        background-color: #f6edfd;
        color: #383ffa;
        border: none;
        border-radius: 3px;
        padding: 6px 8px
    }

    #google_translate_element_2 select {
        background-color: #f6edfd;
        color: #383ffa;
        border: none;
        border-radius: 3px;
        padding: 6px 8px
    }

    .VIpgJd-ZVi9od-aZ2wEe-OiiCO,
    .VIpgJd-ZVi9od-aZ2wEe-OiiCO-ti6hGc {
        display: none !important;
    }

    .cat-card {
        padding: 12px;
    }
</style>
<div x-data="languageSwitcher()" class="relative inline-block text-left">
    <button @click="toggleDropdown"
        class="px-4 py-2 bg-white text-white font-semibold rounded-md shadow hover:bg-green-300 focus:outline-none">
        <img width="30" height="30" src="https://img.icons8.com/fluency/30/language.png" alt="language" />
    </button>

    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50" style="position: absolute">
        <ul class="text-start text-sm text-gray-900">
            <template x-for="(language, index) in languages" :key="index">
                <li translate="no" class="border-b border-gray-300 last:border-0">
                    <a href="#" @click.prevent="changeLanguage(language.code)" x-text="language.name"
                        class="block px-4 font-bold py-2 hover:bg-gray-100 cursor-pointer"></a>
                </li>
            </template>
        </ul>
    </div>
</div>

<div id="google_translate_element" class="hidden"></div>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            autoDisplay: 'true',
            includedLanguages: 'en,de,fr,ja,zh-TW,ko,ar,ru,es,it,hi',
            gaTrack: true
        }, 'google_translate_element');
    }

    function languageSwitcher() {
        return {
            open: false,
            languages: [{
                    code: 'en',
                    name: 'English'
                },
                {
                    code: 'ar',
                    name: 'Arabic'
                },
                {
                    code: 'zh-TW',
                    name: 'Chinese'
                },
                {
                    code: 'fr',
                    name: 'French'
                },
                {
                    code: 'de',
                    name: 'German'
                },
                {
                    code: 'hi',
                    name: 'Hindi'
                },
                {
                    code: 'it',
                    name: 'Italian'
                },
                {
                    code: 'ja',
                    name: 'Japanese'
                },
                {
                    code: 'ko',
                    name: 'Korean'
                },
                {
                    code: 'ru',
                    name: 'Russian'
                },
                {
                    code: 'es',
                    name: 'Spanish'
                }
            ],
            toggleDropdown() {
                this.open = !this.open;
            },
            changeLanguage(lang) {
                var combo = document.querySelector('.goog-te-combo');
                if (combo) {
                    combo.value = lang;
                    combo.dispatchEvent(new Event('change'));
                }
            }
        }
    }
</script>
