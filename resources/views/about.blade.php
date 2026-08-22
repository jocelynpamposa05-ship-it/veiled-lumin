@extends('layouts.public')
@section('title', 'About — Veiled Lumin')
@section('main-class', 'flex-1 w-full py-10 px-4 sm:px-6')

@section('content')

{{-- ── Book wrapper ─────────────────────────────────────────────────── --}}
<div class="flex justify-center px-0 py-4 sm:py-8">

        {{--
            The open book.
            On mobile it stacks; on md+ it sits side-by-side as a spread.
        --}}
        <div class="book-spread w-full max-w-5xl"
             style="
                display: flex;
                flex-direction: column;
                align-items: stretch;
                filter: drop-shadow(0 32px 64px rgba(0,0,0,0.55)) drop-shadow(0 8px 24px rgba(0,0,0,0.4));
             ">

            {{-- ── md+ side-by-side spread ──────────────────────────────── --}}
            <div style="display: flex; flex-direction: column; width: 100%;"
                 class="md:!flex-row">

                {{-- ════════════════ LEFT PAGE ════════════════ --}}
                <div class="book-page book-page-left"
                     style="
                        flex: 1;
                        min-width: 0;
                        background-color: #F5EFE3;
                        background-image:
                            url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%224%22 stitchTiles=%22stitch%22/><feColorMatrix type=%22saturate%22 values=%220%22/></filter><rect width=%22400%22 height=%22400%22 filter=%22url(%23n)%22 opacity=%220.04%22/></svg>');
                        padding: 3rem 2.5rem 3.5rem 3rem;
                        position: relative;
                        border-radius: 4px 0 0 4px;
                        box-shadow:
                            inset -6px 0 18px -4px rgba(0,0,0,0.18),
                            inset -1px 0 0 rgba(0,0,0,0.06);
                     ">

                    {{-- Left page: slight rightward curl at spine --}}
                    <div style="
                        position: absolute;
                        top: 0; right: 0; bottom: 0;
                        width: 24px;
                        background: linear-gradient(to right, rgba(0,0,0,0.07), transparent);
                        pointer-events: none;
                    "></div>

                    {{-- Page number --}}
                    <div style="
                        position: absolute;
                        bottom: 1.5rem; left: 3rem;
                        font-family: 'Fraunces', Georgia, serif;
                        font-size: 0.7rem;
                        color: #9A8A70;
                        letter-spacing: 0.05em;
                    ">i</div>

                    {{-- Content --}}
                    <div style="max-width: 38ch; margin: 0 auto;">

                        {{-- Chapter ornament --}}
                        <div style="text-align: center; margin-bottom: 1.75rem; color: #B8A88A; font-size: 1.1rem; letter-spacing: 0.3em;">
                            ✦ ✦ ✦
                        </div>

                        <h1 style="
                            font-family: 'Fraunces', Georgia, serif;
                            font-size: 1.6rem;
                            font-weight: 400;
                            color: #2C2416;
                            line-height: 1.25;
                            margin-bottom: 1.75rem;
                            padding-bottom: 1rem;
                            border-bottom: 1px solid rgba(0,0,0,0.1);
                        ">About Veiled Lumin</h1>

                        <div style="
                            font-family: 'Fraunces', Georgia, serif;
                            font-size: 0.95rem;
                            line-height: 1.9;
                            color: #3D3020;
                        ">
                            <p style="margin-bottom: 1.2em;">
                                Welcome to <strong style="font-weight:500;">Veiled Lumin</strong> — a quiet space
                                for poems that live between what is felt and what is said.
                            </p>

                            <p style="margin-bottom: 1.2em;">
                                Some feelings are difficult to explain. Some memories remain long after the moment
                                has passed. And some thoughts are easier to express through a few carefully chosen words.
                            </p>

                            <p style="margin-bottom: 1.2em;">
                                <strong style="font-weight:500;">Veiled Lumin</strong> was created as a personal
                                collection of those words — a place where emotions, memories, dreams, solitude,
                                love, loss, and the small moments of life can take shape through poetry.
                            </p>

                            <p style="margin-bottom: 1.2em;">
                                Here, every poem carries a piece of a feeling. Some may speak of love, others of
                                heartbreak, hope, longing, or simply the quiet thoughts that appear when the
                                world becomes still.
                            </p>

                            <p style="margin-bottom: 1.2em;">
                                This is not a place where every feeling needs an explanation.
                            </p>

                            <p style="
                                font-style: italic;
                                font-size: 1.05rem;
                                color: #5A3E1B;
                                margin-top: 2rem;
                                padding-left: 1.25rem;
                                border-left: 2px solid #C8A86B;
                                line-height: 1.7;
                            ">
                                Sometimes, a poem is enough.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- ════════════════ BOOK SPINE ════════════════ --}}
                <div style="
                    width: 28px;
                    flex-shrink: 0;
                    background: linear-gradient(
                        to right,
                        #C8B89A 0%,
                        #EDE3D0 20%,
                        #F0E6D2 50%,
                        #EDE3D0 80%,
                        #C8B89A 100%
                    );
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow:
                        -3px 0 12px rgba(0,0,0,0.15),
                        3px 0 12px rgba(0,0,0,0.15);
                ">
                    {{-- Spine crease line --}}
                    <div style="
                        width: 1px;
                        height: 100%;
                        background: linear-gradient(
                            to bottom,
                            transparent 0%,
                            rgba(0,0,0,0.12) 15%,
                            rgba(0,0,0,0.18) 50%,
                            rgba(0,0,0,0.12) 85%,
                            transparent 100%
                        );
                    "></div>
                </div>

                {{-- ════════════════ RIGHT PAGE ════════════════ --}}
                <div class="book-page book-page-right"
                     style="
                        flex: 1;
                        min-width: 0;
                        background-color: #F5EFE3;
                        background-image:
                            url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%224%22 stitchTiles=%22stitch%22/><feColorMatrix type=%22saturate%22 values=%220%22/></filter><rect width=%22400%22 height=%22400%22 filter=%22url(%23n)%22 opacity=%220.04%22/></svg>');
                        padding: 3rem 3rem 3.5rem 2.5rem;
                        position: relative;
                        border-radius: 0 4px 4px 0;
                        box-shadow:
                            inset 6px 0 18px -4px rgba(0,0,0,0.18),
                            inset 1px 0 0 rgba(0,0,0,0.06);
                     ">

                    {{-- Right page: slight leftward curl at spine --}}
                    <div style="
                        position: absolute;
                        top: 0; left: 0; bottom: 0;
                        width: 24px;
                        background: linear-gradient(to left, rgba(0,0,0,0.07), transparent);
                        pointer-events: none;
                    "></div>

                    {{-- Page number --}}
                    <div style="
                        position: absolute;
                        bottom: 1.5rem; right: 3rem;
                        font-family: 'Fraunces', Georgia, serif;
                        font-size: 0.7rem;
                        color: #9A8A70;
                        letter-spacing: 0.05em;
                    ">ii</div>

                    {{-- Content --}}
                    <div style="max-width: 38ch; margin: 0 auto;">

                        {{-- Chapter ornament --}}
                        <div style="text-align: center; margin-bottom: 1.75rem; color: #B8A88A; font-size: 1.1rem; letter-spacing: 0.3em;">
                            ✦ ✦ ✦
                        </div>

                        <h2 style="
                            font-family: 'Fraunces', Georgia, serif;
                            font-size: 1.6rem;
                            font-weight: 400;
                            color: #2C2416;
                            line-height: 1.25;
                            margin-bottom: 1.75rem;
                            padding-bottom: 1rem;
                            border-bottom: 1px solid rgba(0,0,0,0.1);
                        ">Why Veiled Lumin?</h2>

                        <div style="
                            font-family: 'Fraunces', Georgia, serif;
                            font-size: 0.95rem;
                            line-height: 1.9;
                            color: #3D3020;
                        ">
                            <p style="margin-bottom: 1.2em;">
                                The name <strong style="font-weight:500;">Veiled Lumin</strong> represents the
                                idea of a <em>hidden light</em> — something beautiful that exists beneath the
                                surface, waiting to be revealed.
                            </p>

                            <p style="margin-bottom: 1.2em;">
                                Like poetry, that light may not always be obvious.
                            </p>

                            <p style="margin-bottom: 1.2em;">
                                It can be found in a memory, a passing thought, a quiet sadness, a moment of
                                happiness, or a feeling that was never spoken aloud.
                            </p>

                            <p style="
                                font-style: italic;
                                font-size: 1.05rem;
                                color: #5A3E1B;
                                margin-top: 2rem;
                                margin-bottom: 2rem;
                                padding-left: 1.25rem;
                                border-left: 2px solid #C8A86B;
                                line-height: 1.7;
                            ">
                                Veiled Lumin is where those hidden things are given a voice.
                            </p>

                            {{-- Closing invitation --}}
                            <div style="
                                margin-top: 2.5rem;
                                padding-top: 1.5rem;
                                border-top: 1px solid rgba(0,0,0,0.08);
                                text-align: center;
                            ">
                                <p style="margin-bottom: 0.6em; color: #6B5A40; font-size: 0.88rem;">
                                    Take your time. Read slowly. Stay with the words.
                                </p>
                                <p style="font-style: italic; color: #9A8A70; font-size: 0.85rem; line-height: 1.7;">
                                    Perhaps somewhere between the lines,<br>
                                    you will find something that feels familiar.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ── Bottom book edge shadow (gives depth / thickness) ─────── --}}
            <div style="
                height: 10px;
                background: linear-gradient(to bottom, #B8A88A, #9A8A6A);
                border-radius: 0 0 3px 3px;
                box-shadow: 0 6px 16px rgba(0,0,0,0.35);
            "></div>

        </div>
    </div>

{{-- Responsive: stack pages on small screens --}}
<style>
@media (max-width: 767px) {
    .book-page-left  { border-radius: 4px 4px 0 0 !important; box-shadow: none !important; padding: 2.5rem 1.75rem !important; }
    .book-page-right { border-radius: 0 0 4px 4px !important; box-shadow: none !important; padding: 2.5rem 1.75rem !important; }
    .book-spread > div { flex-direction: column !important; }
    /* Hide spine on mobile — pages stack vertically */
    .book-spread > div > div:nth-child(2) { width: 100% !important; height: 12px !important; background: linear-gradient(to bottom, #C8B89A 0%, #EDE3D0 50%, #C8B89A 100%) !important; box-shadow: none !important; }
}
</style>

@endsection
