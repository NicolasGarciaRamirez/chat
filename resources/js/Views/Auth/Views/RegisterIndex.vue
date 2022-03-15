<template>
    <div class="auth-content">
        <div class="d-flex justify-content-center pt-5 mb-5" >
            <div class="btn-slide my-auto">

                <input type="radio" name="sectionActive" v-model="sectionActive" value="Noisesharks" id="noisesharks" autocomplete="off"  >
                <label for="noisesharks">Noiseshark</label>

                <input type="radio" name="sectionActive" v-model="sectionActive" value="Noisemeg" id="noisemeg" autocomplete="off" >
                <label for="noisemeg">Noisemeg</label>

                <!-- </label> -->
                <div class="glider"></div>

            </div>
        </div>
        <div >
            <noisesharks v-if="sectionActive == 'Noisesharks'" />
            <noisemeg v-else />
        </div>
        <div class="accordion pb-4" id="AccordionChannel">
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-1" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold"> How do I get paid? </button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-1" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-2" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Who is Noisesharks for?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-2" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-3" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">What are the different ways that I can make money as a Noiseshark?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-3" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-4" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">How much can I earn?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-4" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-5" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Can I support other noisesharks as a noiseshark?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-5" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-6" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">What is the 15% price plan?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-6" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-7" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">What is the 0% price plan?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-7" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header" data-target="item-8" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">What is a Noisemeg?</button>
                        <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                    </div>
                </div>
                <div id="item-8" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header instagram" data-target="item-9" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Instagram</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path  d="M15.3,30H15c-2.35,0-4.53-.05-6.64-.18a8.84,8.84,0,0,1-5.11-1.94A8.18,8.18,0,0,1,.49,23.43,19.74,19.74,0,0,1,0,18.72c0-1.1,0-2.4,0-3.72s0-2.62,0-3.72A19.74,19.74,0,0,1,.49,6.57,8.22,8.22,0,0,1,3.25,2.12,8.84,8.84,0,0,1,8.36.18C10.47.05,12.65,0,15,0s4.53.05,6.64.18a8.84,8.84,0,0,1,5.11,1.94,8.22,8.22,0,0,1,2.76,4.45A19.74,19.74,0,0,1,30,11.28c0,1.1,0,2.4,0,3.72h0c0,1.32,0,2.62,0,3.72a19.74,19.74,0,0,1-.46,4.71,8.18,8.18,0,0,1-2.76,4.45,8.84,8.84,0,0,1-5.11,1.94C19.62,29.94,17.54,30,15.3,30ZM15,27.66c2.31,0,4.43-.06,6.5-.18a6.51,6.51,0,0,0,3.77-1.41,5.88,5.88,0,0,0,2-3.22,18.14,18.14,0,0,0,.38-4.17c0-1.08,0-2.37,0-3.68s0-2.6,0-3.68a18.14,18.14,0,0,0-.38-4.17,5.81,5.81,0,0,0-2-3.21A6.45,6.45,0,0,0,21.5,2.52c-2.07-.12-4.19-.18-6.5-.18s-4.43.06-6.5.18A6.45,6.45,0,0,0,4.73,3.94a5.81,5.81,0,0,0-2,3.21,18.14,18.14,0,0,0-.38,4.17c0,1.09,0,2.38,0,3.68s0,2.6,0,3.68a18.14,18.14,0,0,0,.38,4.17,5.88,5.88,0,0,0,2,3.22A6.51,6.51,0,0,0,8.5,27.48C10.57,27.6,12.69,27.66,15,27.66Zm-.06-5.34A7.32,7.32,0,1,1,22.27,15,7.32,7.32,0,0,1,14.94,22.32Zm0-12.3a5,5,0,1,0,5,5A5,5,0,0,0,14.94,10Zm8.15-4.69a1.76,1.76,0,1,0,1.75,1.76A1.76,1.76,0,0,0,23.09,5.33Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-9" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header youtube" data-target="item-10" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + YouTube</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 20.63"><path d="M28.77,2.06C28,.61,27.08.34,25.28.23S19,0,15.06,0,6.62,0,4.82.12,2.14.48,1.31,1.92,0,5.85,0,10.24H0c0,4.37.4,6.88,1.23,8.31s1.69,1.72,3.49,1.85,6.31.2,10.23.22,8.43,0,10.23-.11,2.68-.37,3.5-1.82S30,14.77,30,10.41h0C30,6,29.61,3.51,28.77,2.06ZM11.22,15.92l.06-11.25,9.34,5.68Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-10" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header twitch" data-target="item-11" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Twitch</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.74 30"><path  d="M0,5.25,0,26.1H7.21V30h3.92L15,26.08h5.88l7.82-7.82L28.72,0,2,0ZM4.56,2.64l21.55,0,0,14.33-4.57,4.57H14.38l-3.91,3.91V21.52H4.59Z"/><path  d="M11.75,7.84h2.61l0,7.82H11.77Z"/><path  d="M18.93,7.83h2.61v7.82H18.94Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-11" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header tiktok" data-target="item-12" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + TikTok</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.26 30"><path  d="M7.91,14.87a4.42,4.42,0,0,0-2.3,8.24,4.29,4.29,0,0,1-.71-2.32,4.45,4.45,0,0,1,4.48-4.5,4.63,4.63,0,0,1,1.41.22v-5a9.36,9.36,0,0,0-1.41-.1H9.32V15.1A4.43,4.43,0,0,0,7.91,14.87Z"/><path  d="M18.72,0H17.4a7.62,7.62,0,0,0,2.86,4.57A7.66,7.66,0,0,1,18.72,0Z"/><path  d="M26.26,7.55a7.43,7.43,0,0,1-1.42-.14V11A12.3,12.3,0,0,1,20,10a13.25,13.25,0,0,1-2.75-1.6l0,11a9.19,9.19,0,0,1-2.75,6.52,9.37,9.37,0,0,1-5.22,2.61,9.55,9.55,0,0,1-1.41.1,9.36,9.36,0,0,1-5.75-1.94c.18.22.38.43.59.64A9.41,9.41,0,0,0,9.39,30a11,11,0,0,0,1.41-.1A9.38,9.38,0,0,0,16,27.28a9.15,9.15,0,0,0,2.74-6.52l-.09-11a12,12,0,0,0,2.75,1.6,12.3,12.3,0,0,0,4.83,1"/><path  d="M9.32,28.48a9.37,9.37,0,0,0,5.22-2.61,9.19,9.19,0,0,0,2.75-6.52l0-11A12.75,12.75,0,0,0,20,10a12.52,12.52,0,0,0,4.83,1V7.41a7.55,7.55,0,0,1-4.57-2.84A7.58,7.58,0,0,1,17.41,0H13.88V20.72a4.45,4.45,0,0,1-3.08,4.21,4.31,4.31,0,0,1-1.66.21,4.48,4.48,0,0,1-3.52-2,4.42,4.42,0,0,1,2.3-8.24,4.72,4.72,0,0,1,1.41.22V11.44a9.39,9.39,0,0,0-6.58,2.73,9.18,9.18,0,0,0-.58,12.46,9.39,9.39,0,0,0,5.75,1.95,9.55,9.55,0,0,0,1.41-.1Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>

                    </div>
                </div>
                <div id="item-12" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header soundcloud" data-target="item-13" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Soundcloud</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 41 20.5"><path  d="M10.25,20.5h2.56V4.36a6.59,6.59,0,0,0-2.56,1.42ZM5.13,9.58v10.9l.16,0h2.4V9.57H5.13ZM0,15A5.49,5.49,0,0,0,2.56,19.7V10.37A5.48,5.48,0,0,0,0,15ZM15.38,20.5h2.56V5.07a6.55,6.55,0,0,0-2.56-.91ZM35.71,9.57H34.27a8.83,8.83,0,0,0,.12-1.37A8.08,8.08,0,0,0,26.45,0,7.76,7.76,0,0,0,20.5,2.81V20.5H35.71A5.38,5.38,0,0,0,41,15,5.38,5.38,0,0,0,35.71,9.57Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-13" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header twitter" data-target="item-14" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Twiiter</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 25.88"><path  d="M29.21,3.68c-.14,0-.28.13-.41.13-1,.28-1-.13-.28-.81.14-.28.41-.55.69-1,.54-.81,0-1.09-.82-.81-.27.13-.68.27-1,.4A3.6,3.6,0,0,1,24.57,1,5.84,5.84,0,0,0,21.17,0a6.18,6.18,0,0,0-4.5,1.91,6.5,6.5,0,0,0-1.91,4.63v.82c0,.41-.68.68-1.49.54A16.57,16.57,0,0,1,7.54,6,17.23,17.23,0,0,1,2.78,2.45c-.68-.68-1.5-.54-1.77.27A7.85,7.85,0,0,0,.73,4.5a6.36,6.36,0,0,0,.82,3.13,7.83,7.83,0,0,0,1,1.23c.55.68.55,1.08-.27.81A11.13,11.13,0,0,1,.87,9.13h0a6.63,6.63,0,0,0,1.5,4.22,4.78,4.78,0,0,0,2,1.64c.68.4,1.09.68.68.81H3.73c-.27,0-.41.68.14,1.5a7,7,0,0,0,1.36,1.64,7.81,7.81,0,0,0,2,1.09c1,.27,1.09.68.27,1.22A12.37,12.37,0,0,1,1,23H.19c-.41,0-.14.41.68.82a17.47,17.47,0,0,0,8.31,2,19.45,19.45,0,0,0,6.4-1.09,16.19,16.19,0,0,0,5.18-3,22.24,22.24,0,0,0,3.68-4.23,18.45,18.45,0,0,0,2.31-5,17.8,17.8,0,0,0,.82-5.31V6.81c0-.27.55-.82,1.23-1.5a5.71,5.71,0,0,0,.81-.95C30.3,3.68,30,3.41,29.21,3.68Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-14" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header facebook" data-target="item-15" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Facebook</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 30"><path d="M4.64,30H8.18a1.51,1.51,0,0,0,1.5-1.5V16.36a1.52,1.52,0,0,1,1.5-1.5h1.64a1.48,1.48,0,0,0,1.5-1.36c.13-.55.13-1.23.27-1.91a1.51,1.51,0,0,0-1.5-1.77H11.45A1.52,1.52,0,0,1,10,8.32V6.41a1.5,1.5,0,0,1,1.5-1.23H13.5A1.51,1.51,0,0,0,15,3.68V1.5A1.51,1.51,0,0,0,13.5,0H10.23c-7,0-6.82,5.05-6.82,5.86V8.45A1.51,1.51,0,0,1,1.91,10H1.5A1.52,1.52,0,0,0,0,11.45v1.78a1.51,1.51,0,0,0,1.5,1.5h0A1.51,1.51,0,0,1,3,16.23v12A1.79,1.79,0,0,0,4.64,30Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-15" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header linkedin" data-target="item-16" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Linkedin</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path  d="M30,30h0V19c0-5.39-1.16-9.53-7.45-9.53a6.54,6.54,0,0,0-5.89,3.23h-.08V10h-6V30h6.21V20.08c0-2.61.5-5.13,3.73-5.13s3.24,3,3.24,5.3V30Z"/><path  d="M.49,10H6.71V30H.49Z"/><path  d="M3.6,0A3.62,3.62,0,1,0,7.2,3.6,3.6,3.6,0,0,0,3.6,0Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-16" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header whatsapp" data-target="item-17" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Whatsapp</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30.14"><path  d="M25.63,4.38A14.93,14.93,0,0,0,.13,14.94a14.75,14.75,0,0,0,2,7.46L0,30.14l7.92-2.07a15,15,0,0,0,7.14,1.82h0A14.95,14.95,0,0,0,25.63,4.38Zm-10.57,23h0a12.41,12.41,0,0,1-6.32-1.73l-.45-.27L3.59,26.6,4.84,22l-.29-.47a12.31,12.31,0,0,1-1.9-6.6A12.42,12.42,0,1,1,15.06,27.36Zm6.81-9.3c-.37-.18-2.21-1.09-2.55-1.21s-.59-.19-.84.19-1,1.21-1.18,1.46-.43.28-.81.09a10.14,10.14,0,0,1-3-1.85,11.45,11.45,0,0,1-2.08-2.58c-.21-.38,0-.56.17-.77a10.25,10.25,0,0,0,.93-1.27.69.69,0,0,0,0-.66c-.09-.18-.84-2-1.15-2.77s-.61-.63-.84-.64H9.77a1.35,1.35,0,0,0-1,.47,4.17,4.17,0,0,0-1.31,3.11A7.21,7.21,0,0,0,9,15.48a16.59,16.59,0,0,0,6.37,5.64,21.94,21.94,0,0,0,2.13.78,5,5,0,0,0,2.35.15,3.83,3.83,0,0,0,2.52-1.78,3.15,3.15,0,0,0,.22-1.77C22.49,18.34,22.25,18.25,21.87,18.06Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-17" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header gmail" data-target="item-18" >
                    <div>
                        <button type="button" class="btn btn-link text-white font-weight-bold">Using Noisesharks + Gmail</button>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 22.5"><path d="M27.19,0H2.81A2.81,2.81,0,0,0,0,2.81V19.69A2.81,2.81,0,0,0,2.81,22.5H27.19A2.81,2.81,0,0,0,30,19.69V2.81A2.81,2.81,0,0,0,27.19,0ZM23.88,1.88,15,8.88l-8.88-7Zm2.37,18.75H3.75V5L15,13.61,26.25,5Z"/></svg>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div id="item-18" class="card-body">
                    <div class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed alias molestiae praesentium sint eligendi nemo, maxime, quae eius, consectetur neque tenetur. Commodi fuga, praesentium rerum dicta reprehenderit omnis. Sit, sed?
                    </div>
                </div>
            </div>
        </div>

        <general-comming-soon></general-comming-soon>
        <general-comming-very-soon></general-comming-very-soon>
        <modal-payment-proccess-fee></modal-payment-proccess-fee>
        <modal-invite></modal-invite>
        <modal-form-invite></modal-form-invite>
        <modal-success-mail></modal-success-mail>
        <modal-invite-form-sign-up :code_invite="code"></modal-invite-form-sign-up>
    </div>
    </section>
</template>

<script>
    import Noisemeg from '../Components/Noisemeg'
    import Noisesharks from '../Components/Noisesharks'

    import FormSignUp from "../Components/FormSignUp";
    import GeneralCommingSoon from "../../CommingSoon/Components/GeneralCommingSoon";
    import GeneralCommingVerySoon from "../../CommingSoon/Components/GeneralCommingVerySoon";
    import Auth from "../../../helpers/Auth";
    import SummarySubscription from "../../Payments/Components/SummarySubscription";
    import ModalPaymentProccessFee from "../Components/ModalPaymentProccessFee";
    import Location from "../../../helpers/Location";
    import StripeKeys from "../../../helpers/StripeKeys";
    import ModalInvite from "../includes/ModalInvite";
    import ModalFormInvite from "../includes/ModalFormInvite";
    import Payment from "../../../helpers/Payment";
    import ModalSuccessMail from "../includes/ModalSuccessMail";
    import ModalInviteFormSignUp from "../includes/ModalInviteFormSignUp"

    import Functionality from '../../../helpers/Functionality'

    export default {
        props: ['type', 'subscription_type'],
        components: {
            ModalSuccessMail,
            SummarySubscription,
            FormSignUp,
            GeneralCommingSoon,
            GeneralCommingVerySoon,
            ModalPaymentProccessFee,
            ModalInvite,
            ModalFormInvite,
            ModalInviteFormSignUp,
            Noisesharks,
            Noisemeg
        },
        data(){
            return {
                sectionActive: 'Noisesharks',
                auth: {
                    username: null
                },
                summary:{
                    amount: this.subscription_type === 'Percentage' ? 10 : 3
                },
                user: null,
                currency: null,
                code: ''
            }
        },
        mounted() {
            Functionality.accordion('#AccordionChannel')

            Auth.initialize()
            let self = this
            this.auth = Auth.state
            if(Auth.state.username){
                this.getUser()
            }
            $.getJSON('https://api.ipstack.com/check?access_key='+StripeKeys.data_keys.CLIENT_IP_STACK_LOCATION, function (res){
                if(res.currency && res.continent_code) {
                    self.currency = res.currency.symbol_native
                }
            })
        },
        methods:{
            async getUser(){
                await Auth.setSession()
                await axios.post(`/User/get/${Auth.state.username}`).then(res=>{
                    this.user = res.data.user;
                }).catch(err =>{Auth.keepLogged(err.response.status)})
            },
            showModalForMusicCompany(){
                $('#ModalForMusic').modal('show')
            },
            showModalVerySoon(){
                $('#ModalGeneralCommingSoon').modal('show')
            },
            showModalPaymentProccessFee(){
                $('#ModalPaymentProccessFee').modal('show')
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
