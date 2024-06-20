@extends('Front.app')
@section('content')
    <main>
        <style>
            .bee-row,
            .bee-row-content {
                position: relative
            }

            body {
                background-color: #ffffff;
                color: #000000;
                font-family: Arial, Helvetica, sans-serif
            }

            a {
                color: #7747FF
            }

            * {
                box-sizing: border-box
            }

            body,
            h1,
            h2,
            h3,
            p {
                margin: 0
            }

            .bee-row-content {
                max-width: 1295px;
                margin: 0 auto;
                display: flex
            }

            .bee-row-content .bee-col-w1 {
                flex-basis: 8%
            }

            .bee-row-content .bee-col-w2 {
                flex-basis: 17%
            }

            .bee-row-content .bee-col-w3 {
                flex-basis: 25%
            }

            .bee-row-content .bee-col-w4 {
                flex-basis: 33%
            }

            .bee-row-content .bee-col-w5 {
                flex-basis: 42%
            }

            .bee-row-content .bee-col-w7 {
                flex-basis: 58%
            }

            .bee-row-content .bee-col-w8 {
                flex-basis: 67%
            }

            .bee-row-content .bee-col-w12 {
                flex-basis: 100%
            }

            .bee-button .content {
                text-align: center
            }

            .bee-button a,
            .bee-icon .bee-icon-label-right a {
                text-decoration: none
            }

            .bee-image {
                overflow: auto
            }

            .bee-image .bee-center {
                margin: 0 auto
            }

            .bee-row-1 .bee-col-2 .bee-block-3,
            .bee-row-15 .bee-col-2 .bee-block-1,
            .bee-row-15 .bee-col-2 .bee-block-3,
            .bee-row-15 .bee-col-3 .bee-block-2,
            .bee-row-15 .bee-col-3 .bee-block-4,
            .bee-row-17 .bee-col-3 .bee-block-1,
            .bee-row-3 .bee-col-3 .bee-block-1,
            .bee-row-5 .bee-col-1 .bee-block-1,
            .bee-row-8 .bee-col-2 .bee-block-6,
            .bee-row-9 .bee-col-2 .bee-block-2 {
                width: 100%
            }

            .bee-icon {
                display: inline-block;
                vertical-align: middle
            }

            .bee-icon .bee-content {
                display: flex;
                align-items: center
            }

            .bee-image img {
                display: block;
                width: 100%
            }

            .bee-paragraph {
                overflow-wrap: anywhere
            }

            .bee-row-1,
            .bee-row-19,
            .bee-row-20,
            .bee-row-21,
            .bee-row-22,
            .bee-row-23,
            .bee-row-7,
            .bee-row-8 {
                background-color: #162c39;
                background-repeat: no-repeat
            }

            .bee-row-24,
            .bee-row-24 .bee-row-content {
                background-color: #ffffff;
                background-repeat: no-repeat
            }

            .bee-row-1 .bee-row-content,
            .bee-row-8 .bee-row-content {
                background-repeat: no-repeat;
                color: #000000
            }

            .bee-row-1 .bee-col-1,
            .bee-row-1 .bee-col-2,
            .bee-row-1 .bee-col-3,
            .bee-row-10 .bee-col-1,
            .bee-row-11 .bee-col-1,
            .bee-row-11 .bee-col-2,
            .bee-row-11 .bee-col-3,
            .bee-row-12 .bee-col-1,
            .bee-row-12 .bee-col-2,
            .bee-row-12 .bee-col-3,
            .bee-row-13 .bee-col-1,
            .bee-row-13 .bee-col-2,
            .bee-row-13 .bee-col-3,
            .bee-row-14 .bee-col-1,
            .bee-row-15 .bee-col-1,
            .bee-row-15 .bee-col-4,
            .bee-row-16 .bee-col-1,
            .bee-row-18 .bee-col-1,
            .bee-row-19 .bee-col-1,
            .bee-row-2 .bee-col-1,
            .bee-row-21 .bee-col-1,
            .bee-row-22 .bee-col-1,
            .bee-row-22 .bee-col-2,
            .bee-row-22 .bee-col-3,
            .bee-row-22 .bee-col-4,
            .bee-row-23 .bee-col-1,
            .bee-row-24 .bee-col-1,
            .bee-row-4 .bee-col-1,
            .bee-row-6 .bee-col-1,
            .bee-row-7 .bee-col-1,
            .bee-row-8 .bee-col-1,
            .bee-row-8 .bee-col-2,
            .bee-row-8 .bee-col-3,
            .bee-row-9 .bee-col-1,
            .bee-row-9 .bee-col-2,
            .bee-row-9 .bee-col-3 {
                padding-bottom: 5px;
                padding-top: 5px
            }

            .bee-row-1 .bee-col-2 .bee-block-2,
            .bee-row-11 .bee-col-2 .bee-block-1,
            .bee-row-12 .bee-col-2 .bee-block-1,
            .bee-row-13 .bee-col-2 .bee-block-1,
            .bee-row-17 .bee-col-1 .bee-block-2,
            .bee-row-20 .bee-col-2 .bee-block-1,
            .bee-row-22 .bee-col-2 .bee-block-1,
            .bee-row-22 .bee-col-2 .bee-block-2,
            .bee-row-22 .bee-col-2 .bee-block-3,
            .bee-row-22 .bee-col-2 .bee-block-4,
            .bee-row-22 .bee-col-2 .bee-block-5,
            .bee-row-22 .bee-col-2 .bee-block-6,
            .bee-row-22 .bee-col-3 .bee-block-1,
            .bee-row-22 .bee-col-3 .bee-block-2,
            .bee-row-22 .bee-col-3 .bee-block-3,
            .bee-row-22 .bee-col-3 .bee-block-4,
            .bee-row-22 .bee-col-3 .bee-block-5,
            .bee-row-22 .bee-col-4 .bee-block-1,
            .bee-row-22 .bee-col-4 .bee-block-2,
            .bee-row-22 .bee-col-4 .bee-block-3,
            .bee-row-3 .bee-col-1 .bee-block-2,
            .bee-row-5 .bee-col-3 .bee-block-1,
            .bee-row-8 .bee-col-2 .bee-block-2 {
                padding: 10px;
                text-align: center;
                width: 100%
            }

            .bee-row-1 .bee-col-2 .bee-block-4,
            .bee-row-8 .bee-col-2 .bee-block-3 {
                padding: 10px 10px 20px
            }

            .bee-row-10,
            .bee-row-11,
            .bee-row-12,
            .bee-row-13,
            .bee-row-14,
            .bee-row-15,
            .bee-row-16,
            .bee-row-17,
            .bee-row-18,
            .bee-row-2,
            .bee-row-3,
            .bee-row-4,
            .bee-row-5,
            .bee-row-6 {
                background-repeat: no-repeat
            }

            .bee-row-10 .bee-row-content,
            .bee-row-11 .bee-row-content,
            .bee-row-12 .bee-row-content,
            .bee-row-13 .bee-row-content,
            .bee-row-14 .bee-row-content,
            .bee-row-15 .bee-row-content,
            .bee-row-16 .bee-row-content,
            .bee-row-17 .bee-row-content,
            .bee-row-18 .bee-row-content,
            .bee-row-19 .bee-row-content,
            .bee-row-2 .bee-row-content,
            .bee-row-20 .bee-row-content,
            .bee-row-21 .bee-row-content,
            .bee-row-22 .bee-row-content,
            .bee-row-23 .bee-row-content,
            .bee-row-3 .bee-row-content,
            .bee-row-4 .bee-row-content,
            .bee-row-5 .bee-row-content,
            .bee-row-6 .bee-row-content,
            .bee-row-7 .bee-row-content {
                background-repeat: no-repeat;
                border-radius: 0;
                color: #000000
            }

            .bee-row-17 .bee-col-1,
            .bee-row-17 .bee-col-2,
            .bee-row-17 .bee-col-3,
            .bee-row-17 .bee-col-4,
            .bee-row-20 .bee-col-1,
            .bee-row-20 .bee-col-2,
            .bee-row-20 .bee-col-3,
            .bee-row-20 .bee-col-4,
            .bee-row-3 .bee-col-1,
            .bee-row-3 .bee-col-2,
            .bee-row-3 .bee-col-3,
            .bee-row-3 .bee-col-4,
            .bee-row-5 .bee-col-1,
            .bee-row-5 .bee-col-2,
            .bee-row-5 .bee-col-3,
            .bee-row-5 .bee-col-4 {
                padding-bottom: 5px;
                padding-top: 5px;
                display: flex;
                flex-direction: column;
                justify-content: center
            }

            .bee-row-10 .bee-col-1 .bee-block-2,
            .bee-row-17 .bee-col-1 .bee-block-1,
            .bee-row-3 .bee-col-1 .bee-block-1,
            .bee-row-8 .bee-col-2 .bee-block-1 {
                padding: 10px;
                width: 100%
            }

            .bee-row-17 .bee-col-1 .bee-block-3,
            .bee-row-3 .bee-col-1 .bee-block-3,
            .bee-row-5 .bee-col-3 .bee-block-2 {
                padding: 10px 10px 20px;
                text-align: center;
                width: 100%
            }

            .bee-row-15 .bee-col-2,
            .bee-row-15 .bee-col-3,
            .bee-row-17 .bee-col-1 .bee-block-4,
            .bee-row-22 .bee-col-1 .bee-block-1,
            .bee-row-3 .bee-col-1 .bee-block-4,
            .bee-row-5 .bee-col-3 .bee-block-3 {
                padding: 10px
            }

            .bee-row-17 .bee-col-1 .bee-block-5,
            .bee-row-3 .bee-col-1 .bee-block-5,
            .bee-row-5 .bee-col-3 .bee-block-4 {
                padding: 10px;
                text-align: left
            }

            .bee-row-8 .bee-col-2 .bee-block-4 {
                padding: 10px;
                text-align: center
            }

            .bee-row-9 {
                background-image: url('https://d1oco4z2z1fhwp.cloudfront.net/templates/default/8411/seperator.png');
                background-repeat: no-repeat;
                background-size: cover
            }

            .bee-row-9 .bee-row-content {
                background-repeat: no-repeat;
                background-size: auto;
                border-radius: 0;
                color: #000000
            }

            .bee-row-24 .bee-row-content {
                color: #000000
            }

            .bee-row-24 .bee-col-1 .bee-block-1 {
                color: #1e0e4b;
                font-family: Inter, sans-serif;
                font-size: 15px;
                padding-bottom: 5px;
                padding-top: 5px;
                text-align: center
            }

            .bee-row-1 .bee-col-2 .bee-block-4,
            .bee-row-8 .bee-col-2 .bee-block-3 {
                color: #cfcfcf;
                direction: ltr;
                font-size: 19px;
                font-weight: 400;
                letter-spacing: 0;
                line-height: 150%;
                text-align: center
            }

            .bee-row-1 .bee-col-2 .bee-block-4 a,
            .bee-row-17 .bee-col-1 .bee-block-4 a,
            .bee-row-22 .bee-col-1 .bee-block-1 a,
            .bee-row-3 .bee-col-1 .bee-block-4 a,
            .bee-row-5 .bee-col-3 .bee-block-3 a,
            .bee-row-8 .bee-col-2 .bee-block-3 a {
                color: #8a3b8f
            }

            .bee-row-1 .bee-col-2 .bee-block-4 p:not(:last-child),
            .bee-row-17 .bee-col-1 .bee-block-4 p:not(:last-child),
            .bee-row-22 .bee-col-1 .bee-block-1 p:not(:last-child),
            .bee-row-3 .bee-col-1 .bee-block-4 p:not(:last-child),
            .bee-row-5 .bee-col-3 .bee-block-3 p:not(:last-child),
            .bee-row-8 .bee-col-2 .bee-block-3 p:not(:last-child) {
                margin-bottom: 16px
            }

            .bee-row-17 .bee-col-1 .bee-block-4,
            .bee-row-3 .bee-col-1 .bee-block-4,
            .bee-row-5 .bee-col-3 .bee-block-3 {
                color: #393d47;
                direction: ltr;
                font-size: 20px;
                font-weight: 400;
                letter-spacing: 0;
                line-height: 150%;
                text-align: left
            }

            .bee-row-22 .bee-col-1 .bee-block-1 {
                color: #cfcfcf;
                direction: ltr;
                font-size: 17px;
                font-weight: 400;
                letter-spacing: 0;
                line-height: 150%;
                text-align: left
            }

            @media (max-width:768px) {
                img.bee-fullwidthOnMobile {
                    max-width: none !important
                }

                .bee-row-content:not(.no_stack) {
                    display: block
                }

                .bee-row-11 .bee-col-2 .bee-block-1,
                .bee-row-12 .bee-col-2 .bee-block-1,
                .bee-row-13 .bee-col-2 .bee-block-1,
                .bee-row-20 .bee-col-2 .bee-block-1 {
                    text-align: center !important
                }

                .bee-row-11 .bee-col-2 .bee-block-1 h1,
                .bee-row-12 .bee-col-2 .bee-block-1 h1,
                .bee-row-13 .bee-col-2 .bee-block-1 h1,
                .bee-row-20 .bee-col-2 .bee-block-1 h1 {
                    font-size: 44px !important;
                    text-align: center !important
                }
            }

            .bee-row-24 .bee-col-1 .bee-block-1 .bee-icon-image {
                padding: 5px 6px 5px 5px
            }

            .bee-row-24 .bee-col-1 .bee-block-1 .bee-icon:not(.bee-icon-first) .bee-content {
                margin-left: 0
            }

            .bee-row-24 .bee-col-1 .bee-block-1 .bee-icon::not(.bee-icon-last) .bee-content {
                margin-right: 0
            }
        </style>

        <div class="bee-page-container">
            <div class="bee-row bee-row-1">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w8">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:30px;"></div>
                        </div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:38px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:center;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder">APANA MART<a href="*|ARCHIVE|*" rel="noopener"
                                        style="color: #8a3c90;" target="_blank">Best E-Commerce</a> s & Fashion Fiesta</span>
                            </h1>
                        </div>
                        <div class="bee-block bee-block-3 bee-image"><img alt="" class="bee-center bee-autowidth"
                                src="images/Blue_Simple_Lines_Circular_Monogram_Badge_Logo-removebg-preview.png"
                                style="max-width:500px;" /></div>
                        <div class="bee-block bee-block-4 bee-paragraph"></div>
                        <div class="bee-block bee-block-5 bee-spacer">
                            <div class="spacer" style="height:35px;"></div>
                        </div>
                        <div class="bee-block bee-block-6 bee-spacer">
                            <div class="spacer" style="height:35px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-2">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:75px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-3">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-image"><img alt="Guide Number" class="bee-fixedwidth"
                                src="{{ asset('images/thumb/guide1.png') }}" style="max-width:107px;" /></div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:18px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Trendsetters' Spotlight</strong>
                            </h1>
                        </div>
                        <div class="bee-block bee-block-3 bee-heading">
                            <h2
                                style="color:#393d47;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:39px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Influencer Picks</strong>
                            </h2>
                        </div>
                        <div class="bee-block bee-block-4 bee-paragraph">
                            <p>Take a front-row seat as we decode the latest runway trends and translate them into wearable
                                statements.</p>
                        </div>
                        <div class="bee-block bee-block-5 bee-button"><a class="bee-button-content" href="www.example.com"
                                style="font-size: 16px; background-color: #f5c19e; border-bottom: 1px solid #F5C19E; border-left: 1px solid #F5C19E; border-radius: 4px; border-right: 1px solid #F5C19E; border-top: 1px solid #F5C19E; color: #162c39; direction: ltr; font-family: inherit; font-weight: 400; max-width: 100%; padding-bottom: 5px; padding-left: 20px; padding-right: 20px; padding-top: 5px; width: auto; display: inline-block;"
                                target="_blank"><span
                                    style="word-break: break-word; font-size: 16px; line-height: 200%;">Explore the
                                    Collection</span></a></div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w1">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="Fashion " class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/Fashion.png') }}" style="max-width:431px;" /></a></div>
                    </div>
                    <div class="bee-col bee-col-4 bee-col-w1">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-4">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:65px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-5">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="Women Clothing" class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/fashion_2.png') }}" style="max-width:539px;" /></a></div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w1"></div>
                    <div class="bee-col bee-col-3 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:18px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Trendsetters' Spotlight</strong>
                            </h1>
                        </div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h2
                                style="color:#393d47;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:39px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Designer Insights</strong>
                            </h2>
                        </div>
                        <div class="bee-block bee-block-3 bee-paragraph">
                            <p>Take a front-row seat as we decode the latest runway trends and translate them into wearable
                                statements.</p>
                        </div>
                        <div class="bee-block bee-block-4 bee-button"><a class="bee-button-content" href="www.example.com"
                                style="font-size: 16px; background-color: #f5c19e; border-bottom: 1px solid #F5C19E; border-left: 1px solid #F5C19E; border-radius: 4px; border-right: 1px solid #F5C19E; border-top: 1px solid #F5C19E; color: #162c39; direction: ltr; font-family: inherit; font-weight: 400; max-width: 100%; padding-bottom: 5px; padding-left: 20px; padding-right: 20px; padding-top: 5px; width: auto; display: inline-block;"
                                target="_blank"><span
                                    style="word-break: break-word; font-size: 16px; line-height: 200%;">Explore the
                                    Collection</span></a></div>
                    </div>
                    <div class="bee-col bee-col-4 bee-col-w1">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-6">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:65px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-7">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:45px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-8">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w8">
                        <div class="bee-block bee-block-1 bee-image"><img alt="Guide Number"
                                class="bee-center bee-fixedwidth" src="{{ asset('images/thumb/guide3.png') }}"
                                style="max-width:86px;" /></div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:38px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:center;margin-top:0;margin-bottom:0;">
                                <strong>Wardrobe Essentials</strong>
                            </h1>
                        </div>
                        <div class="bee-block bee-block-3 bee-paragraph">
                            <p>we've curated a collection that transcends trends and celebrates individuality. From runway
                                revelations to exclusive sneak peeks</p>
                        </div>
                        <div class="bee-block bee-block-4 bee-button"><a class="bee-button-content"
                                href="www.example.com"
                                style="font-size: 16px; background-color: #f5c19e; border-bottom: 1px solid #F5C19E; border-left: 1px solid #F5C19E; border-radius: 4px; border-right: 1px solid #F5C19E; border-top: 1px solid #F5C19E; color: #162c39; direction: ltr; font-family: inherit; font-weight: 400; max-width: 100%; padding-bottom: 5px; padding-left: 20px; padding-right: 20px; padding-top: 5px; width: auto; display: inline-block;"
                                target="_blank"><span
                                    style="word-break: break-word; font-size: 16px; line-height: 200%;">Explore the
                                    Collection</span></a></div>
                        <div class="bee-block bee-block-5 bee-spacer">
                            <div class="spacer" style="height:35px;"></div>
                        </div>
                        <div class="bee-block bee-block-6 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="Essentials" class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/fashion3.png') }}" style="max-width:518px;" /></a></div>
                        <div class="bee-block bee-block-7 bee-spacer">
                            <div class="spacer" style="height:35px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-9">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:40px;"></div>
                        </div>
                        <div class="bee-block bee-block-2 bee-image"><img alt=""
                                class="bee-center bee-fixedwidth" src="{{ asset('images/thumb/circle.png') }}"
                                style="max-width:140px;" /></div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-10">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:40px;"></div>
                        </div>
                        <div class="bee-block bee-block-2 bee-image"><img alt="Guide Number"
                                class="bee-center bee-fixedwidth" src="{{ asset('images/thumb/guide4.png') }}"
                                style="max-width:90px;" /></div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-11">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w7">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Georgia, Times, 'Times New Roman', serif;font-size:64px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Style Revelations</strong>
                            </h1>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-12">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w8">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Georgia, Times, 'Times New Roman', serif;font-size:64px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Chic Chronicles Unveiled</strong>
                            </h1>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w1">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-13">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w7">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Georgia, Times, 'Times New Roman', serif;font-size:64px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Wardrobe Essentials</strong>
                            </h1>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-14">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:30px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-15">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="Lady wearing pink" class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/girl_pink.png') }}" style="max-width:303px;" /></a></div>
                        <div class="bee-block bee-block-2 bee-spacer">
                            <div class="spacer" style="height:25px;"></div>
                        </div>
                        <div class="bee-block bee-block-3 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="wearing pink" class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/girl_pink1.png') }}" style="max-width:303px;" /></a></div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                        <div class="bee-block bee-block-2 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="wearing pink" class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/girl_pink2_1.png') }}" style="max-width:303px;" /></a>
                        </div>
                        <div class="bee-block bee-block-3 bee-spacer">
                            <div class="spacer" style="height:25px;"></div>
                        </div>
                        <div class="bee-block bee-block-4 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="wearing pink" class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/girl_pink3.png') }}" style="max-width:303px;" /></a>
                        </div>
                    </div>
                    <div class="bee-col bee-col-4 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-16">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:50px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-17">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-image"><img alt="Guide Number" class="bee-fixedwidth"
                                src="{{ asset('images/thumb/guide5.png') }}" style="max-width:107px;" /></div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:18px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Trendsetters' Spotlight</strong>
                            </h1>
                        </div>
                        <div class="bee-block bee-block-3 bee-heading">
                            <h2
                                style="color:#393d47;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:39px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Influencer Picks</strong>
                            </h2>
                        </div>
                        <div class="bee-block bee-block-4 bee-paragraph">
                            <p>Take a front-row seat as we decode the latest runway trends and translate them into wearable
                                statements.</p>
                        </div>
                        <div class="bee-block bee-block-5 bee-button"><a class="bee-button-content"
                                href="www.example.com"
                                style="font-size: 16px; background-color: #f5c19e; border-bottom: 1px solid #F5C19E; border-left: 1px solid #F5C19E; border-radius: 4px; border-right: 1px solid #F5C19E; border-top: 1px solid #F5C19E; color: #162c39; direction: ltr; font-family: inherit; font-weight: 400; max-width: 100%; padding-bottom: 5px; padding-left: 20px; padding-right: 20px; padding-top: 5px; width: auto; display: inline-block;"
                                target="_blank"><span
                                    style="word-break: break-word; font-size: 16px; line-height: 200%;">Explore the
                                    Collection</span></a></div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w1">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w5">
                        <div class="bee-block bee-block-1 bee-image"><a href="www.example.com" target="_blank"><img
                                    alt="Fashion " class="bee-center bee-fixedwidth bee-fullwidthOnMobile"
                                    src="{{ asset('images/thumb/Combo.png') }}" style="max-width:431px;" /></a></div>
                    </div>
                    <div class="bee-col bee-col-4 bee-col-w1">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-18">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:75px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-19">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:50px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-20">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w4">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h1
                                style="color:#f5c19e;direction:ltr;font-family:Georgia, Times, 'Times New Roman', serif;font-size:65px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <strong>Newsletter </strong><strong>Signup</strong>
                            </h1>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w4">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                    <div class="bee-col bee-col-4 bee-col-w2">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:1px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bee-row bee-row-21">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w12">
                        <div class="bee-block bee-block-1 bee-spacer">
                            <div class="spacer" style="height:55px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="bee-row bee-row-22">
                <div class="bee-row-content">
                    <div class="bee-col bee-col-1 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-paragraph">
                            <p>Take a front-row seat as we decode the latest runway trends and translate them into wearable
                                statements.</p>
                        </div>
                    </div>
                    <div class="bee-col bee-col-2 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h3
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder">Explore Collection</span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span class="tinyMce-placeholder">New
                                                in</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-3 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span
                                                class="tinyMce-placeholder">Clothing</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-4 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span
                                                class="tinyMce-placeholder">Shoes</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-5 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span
                                                class="tinyMce-placeholder">Accessories</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-6 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span
                                                class="tinyMce-placeholder">Sale</span></span></a></span>
                            </h3>
                        </div>
                    </div>
                    <div class="bee-col bee-col-3 bee-col-w3">
                        <div class="bee-block bee-block-1 bee-heading">
                            <h3
                                style="color:#f5c19e;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:700;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder">Help & Information</span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-2 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span
                                                class="tinyMce-placeholder">Help</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-3 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span class="tinyMce-placeholder">Track
                                                Order</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-4 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span class="tinyMce-placeholder">Delivery &
                                                returns</span></span></a></span>
                            </h3>
                        </div>
                        <div class="bee-block bee-block-5 bee-heading">
                            <h3
                                style="color:#ffffff;direction:ltr;font-family:Arial, Helvetica, sans-serif;font-size:20px;font-weight:400;letter-spacing:normal;line-height:120%;text-align:left;margin-top:0;margin-bottom:0;">
                                <span class="tinyMce-placeholder"><a href="http://www.example.com" rel="noopener"
                                        style="text-decoration: none; color: #ffffff;" target="_blank"><span
                                            class="mce-content-body mce-edit-focus" data-position="240-1-1"
                                            data-qa="tinyeditor-root-element" id="46c3045c-7867-4077-bd39-c3234b6ae313"
                                            style="position: relative;"><span
                                                class="tinyMce-placeholder">Sitemap</span></span></a></span>
                            </h3>
                        </div>
                    </div>
                 
                </div>
            </div> --}}


        </div>
    </main>
@endsection
