<?php
declare(strict_types=1);

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Zune Web Manager</title>

<style>
* {
    box-sizing: border-box;
}

html,
body {
    margin: 0;
    padding: 0;
    min-height: 100%;
}

body {
    background: #101010;
    color: #eee;
    font-family: Arial, Helvetica, sans-serif;
}

header {
    height: 72px;
    background: #181818;
    border-bottom: 1px solid #303030;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 28px;
}

.brand {
    display: flex;
    align-items: center;
    gap: 14px;
}

.brand-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #eee;
    color: #111;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.brand-title {
    font-size: 20px;
    font-weight: 600;
}

.brand-subtitle {
    color: #888;
    font-size: 12px;
    margin-top: 3px;
}

.connection-state {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #999;
    font-size: 14px;
}

.connection-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #555;
}

.connection-dot.connected {
    background: #63c174;
}

main {
    max-width: 1150px;
    margin: 0 auto;
    padding: 35px 22px 60px;
}

.hero {
    margin-bottom: 28px;
}

.hero h1 {
    margin: 0 0 8px;
    font-size: 32px;
    font-weight: 500;
}

.hero p {
    margin: 0;
    color: #888;
    font-size: 15px;
}

.toolbar {
    display: flex;
    gap: 12px;
    margin-bottom: 22px;
}

button {
    appearance: none;
    border: 0;
    border-radius: 6px;
    padding: 12px 20px;
    background: #eee;
    color: #111;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

button:hover {
    background: #d8d8d8;
}

button:disabled {
    opacity: .45;
    cursor: not-allowed;
}

button.secondary {
    background: #292929;
    color: #eee;
    border: 1px solid #3b3b3b;
}

button.secondary:hover {
    background: #343434;
}

.status {
    border: 1px solid #333;
    background: #181818;
    border-radius: 8px;
    padding: 16px 18px;
    margin-bottom: 22px;
    color: #bbb;
    font-size: 14px;
}

.status.success {
    border-color: #386340;
}

.status.error {
    border-color: #713a38;
    color: #f0b7b4;
}

.status.working {
    border-color: #555;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.card {
    background: #181818;
    border: 1px solid #303030;
    border-radius: 9px;
    overflow: hidden;
}

.card.full {
    grid-column: 1 / -1;
}

.card-header {
    padding: 17px 19px;
    border-bottom: 1px solid #303030;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2 {
    margin: 0;
    font-size: 16px;
}

.card-body {
    padding: 19px;
}

.info {
    display: grid;
    grid-template-columns: 170px 1fr;
    gap: 12px 18px;
    font-size: 14px;
}

.info-label {
    color: #777;
}

.info-value {
    color: #eee;
    overflow-wrap: anywhere;
}

pre {
    margin: 0;
    padding: 16px;
    background: #0c0c0c;
    border: 1px solid #292929;
    border-radius: 6px;
    color: #cfcfcf;
    font-family: Consolas, Monaco, monospace;
    font-size: 12px;
    line-height: 1.6;
    white-space: pre-wrap;
    word-break: break-word;
    overflow-x: auto;
    overflow-y: auto;
    max-height: 320px;
}

.interface {
    border: 1px solid #303030;
    border-radius: 7px;
    margin-bottom: 12px;
    overflow: hidden;
}

.interface:last-child {
    margin-bottom: 0;
}

.interface-title {
    padding: 12px 14px;
    background: #202020;
    font-size: 13px;
    font-weight: 600;
}

.alternate {
    padding: 14px;
    border-top: 1px solid #303030;
}

.alternate-title {
    color: #aaa;
    font-size: 12px;
    margin-bottom: 9px;
}

.endpoint {
    padding: 9px 11px;
    background: #111;
    border-radius: 5px;
    margin-top: 7px;
    font-family: Consolas, Monaco, monospace;
    font-size: 11px;
    color: #c5c5c5;
}

.badge {
    font-size: 11px;
    padding: 5px 8px;
    border-radius: 4px;
    background: #292929;
    color: #aaa;
}

.log-success {
    color: #73ce82;
}

.log-error {
    color: #e17d78;
}

.log-step {
    color: #cfcfcf;
}

.hidden {
    display: none !important;
}

/* ----------------------------------------------------------
 * PICTURE MANAGEMENT
 * ---------------------------------------------------------- */


.picture-card { margin-top: 20px; }
.video-card { margin-top: 20px; }
.video-toolbar { display:flex; flex-wrap:wrap; gap:10px; align-items:center; margin-bottom:12px; }
.video-summary { color:#999; font-size:13px; line-height:1.55; margin:10px 0 14px; }
.video-list { display:grid; gap:10px; margin-top:14px; }
.video-item { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:12px 14px; border:1px solid #303030; border-radius:8px; background:#121212; }
.video-item-main { min-width:0; }
.video-item-name { color:#eee; font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.video-item-meta { margin-top:4px; color:#999; font-size:12px; }
.video-item-actions { display:flex; gap:8px; flex-shrink:0; }
@media (max-width:700px) { .video-item { align-items:flex-start; flex-direction:column; } .video-item-actions { width:100%; } }

.picture-toolbar { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 16px; }
.picture-toolbar input[type="file"] { flex: 1 1 320px; min-width: 220px; color: #ccc; background: #111; border: 1px solid #343434; border-radius: 6px; padding: 9px; }
.picture-summary { color: #999; font-size: 13px; margin-bottom: 14px; }
.picture-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 14px; }
.picture-panel { border: 1px solid #303030; background: #121212; border-radius: 8px; overflow: hidden; }
.picture-preview { width: 100%; aspect-ratio: 4 / 3; object-fit: contain; display: block; background: #0b0b0b; }
.picture-preview-placeholder { width: 100%; aspect-ratio: 4 / 3; display: flex; align-items: center; justify-content: center; color: #666; background: #0b0b0b; font-size: 12px; }
.picture-panel-body { padding: 10px; }
.picture-name { color: #ddd; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.picture-details { color: #777; font-size: 11px; margin-top: 4px; }
.picture-actions { display: flex; gap: 7px; margin-top: 9px; }
.picture-actions button { flex: 1; min-width: 0; padding: 7px 8px; font-size: 11px; }
.picture-log { margin-top: 14px; }

.warning {
    margin-top: 20px;
    border: 1px solid #45402f;
    background: #1d1a12;
    border-radius: 8px;
    padding: 16px 18px;
    color: #c7c0a9;
    font-size: 13px;
    line-height: 1.55;
}


/* ----------------------------------------------------------
 * MUSIC MANAGEMENT
 * ---------------------------------------------------------- */

.music-card {
    margin-top: 20px;
}

.music-toolbar {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    margin-bottom: 16px;
}

.music-toolbar input[type="file"] {
    flex: 1 1 320px;
    min-width: 220px;
    color: #ccc;
    background: #111;
    border: 1px solid #343434;
    border-radius: 6px;
    padding: 9px;
}

.music-summary {
    color: #999;
    font-size: 13px;
    margin-bottom: 14px;
}

.album-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 14px;
}

.album-panel {
    border: 1px solid #303030;
    background: #121212;
    border-radius: 8px;
    overflow: hidden;
}

.album-panel-header {
    padding: 13px 15px;
    border-bottom: 1px solid #2d2d2d;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    user-select: none;
}

.album-panel-header:hover {
    background: #191919;
}

.album-panel.collapsed .album-panel-header {
    border-bottom: 0;
}

.album-panel-toggle {
    width: 18px;
    flex: 0 0 18px;
    text-align: center;
    color: #888;
    font-size: 13px;
}

.album-panel.collapsed .album-panel-artist,
.album-panel.collapsed .album-delete-button,
.album-panel.collapsed .album-track-list {
    display: none;
}

.album-panel-title {
    font-size: 15px;
    color: #eee;
    font-weight: 600;
}

.album-panel-artist {
    margin-top: 4px;
    font-size: 12px;
    color: #888;
}

.album-track-list {
    padding: 8px 12px 12px;
}

.album-track {
    display: grid;
    grid-template-columns: 38px 1fr auto;
    gap: 10px;
    align-items: center;
    padding: 8px 4px;
    border-bottom: 1px solid #242424;
    font-size: 13px;
}

.album-track:last-child {
    border-bottom: 0;
}

.album-track-number {
    color: #777;
    text-align: right;
    font-variant-numeric: tabular-nums;
}

.album-track-title {
    min-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #ddd;
}

.album-track-file {
    color: #666;
    max-width: 170px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 11px;
}

.music-log {
    margin-top: 14px;
}

.scan-state {
    color: #999;
    font-size: 13px;
    margin-top: 10px;
}

.folder-album-selection {
    border: 1px solid #303030;
    background: #111;
    border-radius: 8px;
    margin: 0 0 16px;
    overflow: hidden;
}

.folder-album-selection-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 14px 15px;
    border-bottom: 1px solid #303030;
}

.folder-album-selection-summary {
    color: #888;
    font-size: 12px;
    margin-top: 4px;
}

.folder-album-selection-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.folder-album-selection-actions button {
    padding: 8px 12px;
    font-size: 12px;
}

.folder-album-list {
    max-height: 360px;
    overflow-y: auto;
}

.folder-album-option {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 11px 15px;
    border-bottom: 1px solid #242424;
    cursor: pointer;
}

.folder-album-option:last-child {
    border-bottom: 0;
}

.folder-album-option:hover {
    background: #181818;
}

.folder-album-option input[type="checkbox"] {
    width: 16px;
    height: 16px;
    flex: 0 0 16px;
}

.folder-album-option-info {
    min-width: 0;
    flex: 1;
}

.folder-album-option-title {
    color: #eee;
    font-size: 13px;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.folder-album-option-details {
    color: #777;
    font-size: 11px;
    margin-top: 3px;
}

@media (max-width: 750px) {
    .folder-album-selection-header {
        align-items: flex-start;
        flex-direction: column;
    }
}

@media (max-width: 750px) {
    header {
        padding: 0 16px;
    }

    .brand-subtitle {
        display: none;
    }

    main {
        padding: 25px 15px 45px;
    }

    .grid {
        grid-template-columns: 1fr;
    }

    .card.full {
        grid-column: auto;
    }

    .info {
        grid-template-columns: 130px 1fr;
    }
}
</style>
</head>

<body>

<header>

    <div class="brand">

        <div class="brand-icon">
            Z
        </div>

        <div>
            <div class="brand-title">
                Zune Web Manager
            </div>

            <div class="brand-subtitle">
                Browser-based Zune 30 management
            </div>
        </div>

    </div>

    <div class="connection-state">

        <div
            id="connectionDot"
            class="connection-dot">
        </div>

        <span id="connectionText">
            Not connected
        </span>

    </div>

</header>


<main>

    <section class="hero">

        <h1>
            Zune 30
        </h1>

        <p>
            USB connection and MTPZ authentication
        </p>

    </section>


    <div class="toolbar">

        <button id="connectButton">
            Connect Zune
        </button>

        <button
            id="disconnectButton"
            class="secondary"
            disabled>
            Disconnect
        </button>

    </div>


    <div
        id="status"
        class="status">

        Checking WebUSB support...

    </div>


    <section id="musicCard" class="card full music-card hidden">

        <div class="card-header">
            <h2>Zune music library</h2>
            <span id="musicBadge" class="badge">0 albums</span>
        </div>

        <div class="card-body">
            <div class="music-toolbar">
                <button id="scanMusicButton" class="secondary">
                    Read Zune music
                </button>

                <input
                    id="musicFileInput"
                    type="file"
                    accept="audio/mpeg,.mp3"
                    multiple>

                <button id="uploadMusicButton">
                    Upload MP3s
                </button>
            </div>

            <div class="music-toolbar">
                <input
                    id="musicFolderInput"
                    type="file"
                    webkitdirectory
                    directory
                    multiple
                    accept="audio/mpeg,.mp3">

                <button id="uploadFolderButton" class="secondary" disabled>
                    Upload selected albums
                </button>

                <button id="pauseMusicTransferButton" class="secondary" disabled>
                    Pause transfer
                </button>

                <button id="clearZuneMusicButton" class="secondary" disabled>
                    Clear all music
                </button>

                <button id="mergeZuneAlbumsButton" class="secondary" disabled>
                    Join duplicate albums
                </button>
            </div>

            <div id="folderAlbumSelection" class="folder-album-selection hidden">
                <div class="folder-album-selection-header">
                    <div>
                        <strong>Select albums to upload</strong>
                        <div id="folderAlbumSelectionSummary" class="folder-album-selection-summary">
                            No folder selected.
                        </div>
                    </div>

                    <div class="folder-album-selection-actions">
                        <button id="selectAllFolderAlbumsButton" type="button" class="secondary">
                            Select all
                        </button>
                        <button id="selectNoFolderAlbumsButton" type="button" class="secondary">
                            Unselect all
                        </button>
                    </div>
                </div>

                <div id="folderAlbumList" class="folder-album-list"></div>
            </div>

            <div class="music-summary">
                Album detection order: embedded ID3 album → containing folder name → Unknown Album.
                Album artwork is taken only from the first track in each album, using its embedded ID3 artwork.
                Embedded album artist is preferred; otherwise the track artist is used.
            </div>

            <div id="musicScanState" class="scan-state">
                The music library has not been read yet.
            </div>

            <div id="musicAlbums" class="album-grid" style="margin-top: 14px;"></div>

            <pre id="musicLog" class="music-log">Ready.</pre>
        </div>

    </section>



    <section id="pictureCard" class="card full picture-card hidden">

        <div class="card-header">
            <h2>Zune pictures</h2>
            <span id="pictureBadge" class="badge">0 pictures</span>
        </div>

        <div class="card-body">
            <div class="picture-toolbar">
                <button id="scanPicturesButton" class="secondary">
                    Read Zune pictures
                </button>

                <input id="pictureFileInput" type="file" accept="image/jpeg,.jpg,.jpeg" multiple>
                <button id="uploadPicturesButton">Upload pictures</button>
            </div>

            <div class="picture-toolbar">
                <input id="pictureFolderInput" type="file" webkitdirectory directory multiple accept="image/jpeg,.jpg,.jpeg">

                <button id="uploadPictureFolderButton" class="secondary" disabled>
                    Upload picture folder
                </button>

                <button id="pausePictureTransferButton" class="secondary" disabled>
                    Pause transfer
                </button>

                <button id="clearZunePicturesButton" class="secondary" disabled>
                    Clear all pictures
                </button>
            </div>

            <div class="picture-summary">
                JPEG/JPG transfer is used for the first picture implementation. Before transfer, pictures are automatically resized to fit within 640 × 480 pixels and recompressed as JPEG so they display cleanly on the Zune 30 and avoid oversized image files. Folder paths are not currently recreated as device folders.
            </div>

            <div id="pictureScanState" class="scan-state">
                The picture library has not been read yet.
            </div>

            <div id="pictureGrid" class="picture-grid" style="margin-top: 14px;"></div>
            <pre id="pictureLog" class="picture-log music-log">Ready.</pre>
        </div>

    </section>


    <section id="videoCard" class="card full video-card hidden">

        <div class="card-header">
            <h2>Zune videos</h2>
            <span id="videoBadge" class="badge">0 videos</span>
        </div>

        <div class="card-body">
            <div class="video-toolbar">
                <button id="scanVideosButton" class="secondary">Read Zune videos</button>
                <input id="videoFileInput" type="file" accept="video/*,.wmv,.asf,.mp4,.m4v,.mov,.avi,.mkv,.webm,.mpeg,.mpg" multiple>
                <button id="uploadVideosButton">Upload videos</button>
            </div>

            <div class="video-toolbar">
                <input id="videoFolderInput" type="file" webkitdirectory directory multiple accept="video/*,.wmv,.asf,.mp4,.m4v,.mov,.avi,.mkv,.webm,.mpeg,.mpg">
                <button id="uploadVideoFolderButton" class="secondary" disabled>Upload video folder</button>
                <button id="pauseVideoTransferButton" class="secondary" disabled>Pause transfer</button>
                <button id="clearZuneVideosButton" class="secondary" disabled>Clear all videos</button>
            </div>

            <div class="video-summary">
                Videos are automatically converted in your browser to WMV8-compatible video for the Zune 30: no more than 320 × 240 pixels, up to 30 fps, with WMV2 video and WMA2 audio. Full-size movies can be selected too; the website will downscale and recompress them before transfer. Very large movies may require substantial Chromebook memory and conversion time because the conversion runs locally in the browser.
            </div>

            <div id="videoScanState" class="scan-state">
                The video library has not been read yet.
            </div>

            <div id="videoList" class="video-list"></div>
            <pre id="videoLog" class="picture-log music-log">Ready.</pre>
        </div>

    </section>



    <div
        id="results"
        class="grid hidden">


        <section class="card">

            <div class="card-header">

                <h2>
                    USB Device
                </h2>

                <span class="badge">
                    USB
                </span>

            </div>

            <div class="card-body">

                <div class="info">

                    <div class="info-label">
                        Manufacturer
                    </div>

                    <div
                        id="manufacturer"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        Product
                    </div>

                    <div
                        id="product"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        Vendor ID
                    </div>

                    <div
                        id="vendorId"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        Product ID
                    </div>

                    <div
                        id="productId"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        USB version
                    </div>

                    <div
                        id="usbVersion"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        MTP interface
                    </div>

                    <div
                        id="mtpInterface"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        Bulk IN
                    </div>

                    <div
                        id="bulkIn"
                        class="info-value">
                        —
                    </div>


                    <div class="info-label">
                        Bulk OUT
                    </div>

                    <div
                        id="bulkOut"
                        class="info-value">
                        —
                    </div>

                </div>

            </div>

        </section>


        <section class="card">

            <div class="card-header">

                <h2>
                    MTPZ authentication
                </h2>

                <span class="badge">
                    READ ONLY
                </span>

            </div>

            <div class="card-body">

                <pre id="mtpOutput">Waiting for authentication...</pre>

            </div>

        </section>


        <section class="card full">

            <div class="card-header">

                <h2>
                    USB interfaces
                </h2>

            </div>

            <div
                id="interfaces"
                class="card-body">
            </div>

        </section>


        <section class="card full">

            <div class="card-header">

                <h2>
                    Raw MTP/MTPZ traffic
                </h2>

            </div>

            <div class="card-body">

                <pre id="rawResponse">
No response yet.
                </pre>

            </div>

        </section>


        <section
            id="deviceInfoCard"
            class="card full hidden">

            <div class="card-header">

                <h2>
                    Zune device information
                </h2>

            </div>

            <div class="card-body">

                <div
                    id="deviceInfo"
                    class="info">
                </div>

            </div>

        </section>


    </div>



    <section id="firmwareCard" class="card full" style="margin-top: 20px;">

        <div class="card-header">
            <h2>
                Zune 30 Firmware Recovery
            </h2>
            <span class="badge">RECOVERY</span>
        </div>

        <div class="card-body">
            <p>
                Your Zune is showing the firmware-recovery screen. This uses the
                firmware-upload path implemented by Android File Transfer for Linux: 
                firmware is sent through MTP as <code>UndefinedFirmware (0xB802)</code>
                and the device can then be rebooted.
            </p>

            <input id="firmwareFile" type="file" accept=".bin,.cab" style="margin: 10px 0; width: 100%;">

            <div class="button-row">
                <button id="restoreFirmwareButton" class="secondary">
                    Restore Zune Firmware
                </button>
            </div>

            <pre id="firmwareOutput" style="margin-top: 14px;">Select a Zune firmware file to begin.</pre>
        </div>

    </section>


    <div class="warning">

        <strong>
            Current stage:
        </strong>

        Normal music management is available after MTPZ authentication. The firmware recovery control above
        is a separate, destructive device-software operation and is
        only intended for an official Zune 30 firmware image.

    </div>

</main>


<script>
"use strict";


/*
 * ==========================================================
 * ZUNE WEB MANAGER
 * ==========================================================
 *
 * Browser implementation of:
 *
 *     WebUSB
 *       |
 *       +-- MTP session
 *       |
 *       +-- MTPZ authentication
 *       |
 *       +-- GetDeviceInfo
 *
 * This stage does NOT write music.
 *
 * ==========================================================
 */


/*
 * ----------------------------------------------------------
 * DOM
 * ----------------------------------------------------------
 */

const connectButton =
    document.getElementById("connectButton");

const disconnectButton =
    document.getElementById("disconnectButton");

const restoreFirmwareButton =
    document.getElementById("restoreFirmwareButton");

const firmwareFileInput =
    document.getElementById("firmwareFile");

const firmwareOutput =
    document.getElementById("firmwareOutput");


const musicCard =
    document.getElementById("musicCard");

const scanMusicButton =
    document.getElementById("scanMusicButton");

const musicFileInput =
    document.getElementById("musicFileInput");

const uploadMusicButton =
    document.getElementById("uploadMusicButton");

const musicFolderInput =
    document.getElementById("musicFolderInput");

const uploadFolderButton =
    document.getElementById("uploadFolderButton");

const pauseMusicTransferButton =
    document.getElementById("pauseMusicTransferButton");

const clearZuneMusicButton =
    document.getElementById("clearZuneMusicButton");

const mergeZuneAlbumsButton =
    document.getElementById("mergeZuneAlbumsButton");

const folderAlbumSelection =
    document.getElementById("folderAlbumSelection");

const folderAlbumSelectionSummary =
    document.getElementById("folderAlbumSelectionSummary");

const folderAlbumList =
    document.getElementById("folderAlbumList");

const selectAllFolderAlbumsButton =
    document.getElementById("selectAllFolderAlbumsButton");

const selectNoFolderAlbumsButton =
    document.getElementById("selectNoFolderAlbumsButton");

const musicAlbums =
    document.getElementById("musicAlbums");

const musicBadge =
    document.getElementById("musicBadge");

const musicScanState =
    document.getElementById("musicScanState");

const musicLogOutput =
    document.getElementById("musicLog");

const pictureCard = document.getElementById("pictureCard");
const scanPicturesButton = document.getElementById("scanPicturesButton");
const pictureFileInput = document.getElementById("pictureFileInput");
const uploadPicturesButton = document.getElementById("uploadPicturesButton");
const pictureFolderInput = document.getElementById("pictureFolderInput");
const uploadPictureFolderButton = document.getElementById("uploadPictureFolderButton");
const pausePictureTransferButton = document.getElementById("pausePictureTransferButton");
const clearZunePicturesButton = document.getElementById("clearZunePicturesButton");
const pictureGrid = document.getElementById("pictureGrid");
const pictureBadge = document.getElementById("pictureBadge");
const pictureScanState = document.getElementById("pictureScanState");
const pictureLogOutput = document.getElementById("pictureLog");

const videoCard = document.getElementById("videoCard");
const scanVideosButton = document.getElementById("scanVideosButton");
const videoFileInput = document.getElementById("videoFileInput");
const uploadVideosButton = document.getElementById("uploadVideosButton");
const videoFolderInput = document.getElementById("videoFolderInput");
const uploadVideoFolderButton = document.getElementById("uploadVideoFolderButton");
const pauseVideoTransferButton = document.getElementById("pauseVideoTransferButton");
const clearZuneVideosButton = document.getElementById("clearZuneVideosButton");
const videoList = document.getElementById("videoList");
const videoBadge = document.getElementById("videoBadge");
const videoScanState = document.getElementById("videoScanState");
const videoLogOutput = document.getElementById("videoLog");

let pictureItems = [];
let videoItems = [];
let videoTransferActive = false;
let videoTransferPaused = false;
let videoTransferWaitingForReconnect = false;
let videoTransferCurrent = "";
let ffmpegInstance = null;
let ffmpegLoadingPromise = null;
let videoProbeMessages = null;
let pictureTransferActive = false;
let pictureTransferPaused = false;
let pictureTransferWaitingForReconnect = false;
let pictureTransferCurrent = "";

// Metadata survives manual re-scans for the current browser session.
// The ObjectInfo signature prevents a reused handle from serving stale data.
const musicMetadataCache = new Map();

// ObjectInfo is relatively expensive on MTP. Handles are stable for the life
// of the device library, so reuse ObjectInfo across manual scans. Newly created
// handles simply populate this cache on the next scan.
const musicObjectInfoCache = new Map();

// Upload state is kept in this page rather than in the MTP session. A paused
// transfer can therefore survive a physical USB unplug/reconnect. MTP itself
// does not support continuing the same SendObject transaction after a USB
// session is lost, so resume always happens at a complete-track boundary.
let musicTransferActive = false;
let musicTransferPaused = false;
let musicTransferWaitingForReconnect = false;
let musicTransferCurrentTrack = "";
let musicFastTransport = false;

function updateMusicTransferButton() {
    if (!pauseMusicTransferButton) return;
    pauseMusicTransferButton.disabled = !musicTransferActive;
    pauseMusicTransferButton.textContent = musicTransferPaused
        ? "Resume transfer"
        : "Pause transfer";
}

function requestMusicTransferPause() {
    if (!musicTransferActive) return;

    musicTransferPaused = !musicTransferPaused;

    if (musicTransferPaused) {
        musicLog("Pause requested. The current song will finish, then the transfer will pause safely.");
        setMusicScanState(
            musicTransferCurrentTrack
                ? "Finishing current song, then pausing: " + musicTransferCurrentTrack
                : "Pausing transfer..."
        );
    } else {
        musicLog("Transfer resume requested.");
        setMusicScanState(
            musicTransferCurrentTrack
                ? "Resuming: " + musicTransferCurrentTrack
                : "Resuming transfer..."
        );
    }

    updateMusicTransferButton();
}

async function waitForMusicTransferResume() {
    while (musicTransferPaused || !sessionOpen) {
        if (!sessionOpen) {
            if (!musicTransferWaitingForReconnect) {
                musicTransferWaitingForReconnect = true;
                musicLog("Zune disconnected. Transfer is paused safely. Reconnect the Zune and click Connect Zune to continue.");
            }
            setMusicScanState("Transfer paused — waiting for the Zune to reconnect...");
        } else {
            setMusicScanState("Transfer paused. Click Resume transfer to continue.");
        }

        await new Promise(resolve => setTimeout(resolve, 500));
    }

    if (musicTransferWaitingForReconnect) {
        musicTransferWaitingForReconnect = false;
        musicLog("Zune reconnected. Transfer is continuing from the next safe track boundary.");
    }
}

function musicTransferStarted() {
    musicFastTransport = true;
    musicTransferActive = true;
    musicTransferPaused = false;
    musicTransferWaitingForReconnect = false;
    musicTransferCurrentTrack = "";
    updateMusicTransferButton();
}

function musicTransferFinished() {
    musicFastTransport = false;
    musicTransferActive = false;
    musicTransferPaused = false;
    musicTransferWaitingForReconnect = false;
    musicTransferCurrentTrack = "";
    updateMusicTransferButton();
}

function musicAlbumKey(artist, album) {
    const normalize = value => String(value || "")
        .normalize("NFKC")
        .replace(/\s+/g, " ")
        .trim()
        .toLocaleLowerCase();
    return normalize(artist || "Unknown Artist") + "|||" + normalize(album || "Unknown Album");
}

const statusBox =
    document.getElementById("status");

const results =
    document.getElementById("results");

const connectionDot =
    document.getElementById("connectionDot");

const connectionText =
    document.getElementById("connectionText");

const manufacturer =
    document.getElementById("manufacturer");

const product =
    document.getElementById("product");

const vendorId =
    document.getElementById("vendorId");

const productId =
    document.getElementById("productId");

const usbVersion =
    document.getElementById("usbVersion");

const mtpInterface =
    document.getElementById("mtpInterface");

const bulkIn =
    document.getElementById("bulkIn");

const bulkOut =
    document.getElementById("bulkOut");

const interfacesContainer =
    document.getElementById("interfaces");

const mtpOutput =
    document.getElementById("mtpOutput");

const rawResponse =
    document.getElementById("rawResponse");

const deviceInfoCard =
    document.getElementById("deviceInfoCard");

const deviceInfo =
    document.getElementById("deviceInfo");

// Keep every console/output window pinned to its newest entry once its
// contents become taller than the visible window.  This applies to the
// authentication log, raw MTP traffic, music log, and firmware log.
function keepConsoleAtBottom(element) {
    if (!element) return;
    element.scrollTop = element.scrollHeight;
}

[mtpOutput, rawResponse, musicLogOutput, firmwareOutput].forEach(element => {
    if (!element || typeof MutationObserver === "undefined") return;
    const observer = new MutationObserver(() => keepConsoleAtBottom(element));
    observer.observe(element, { childList: true, characterData: true, subtree: true });
    keepConsoleAtBottom(element);
});


/*
 * ----------------------------------------------------------
 * State
 * ----------------------------------------------------------
 */

let zuneDevice = null;

let mtpInterfaceNumber = null;

let mtpBulkInEndpoint = null;

let mtpBulkInPacketSize = 64;

let mtpBulkOutEndpoint = null;

let transactionId = 0;
let lastReceivedContainerBytes = null;

let sessionOpen = false;
let lastMtpErrorResponse = null;


/*
 * ----------------------------------------------------------
 * MTP constants
 * ----------------------------------------------------------
 */

const MTP_COMMAND  = 0x0001;
const MTP_DATA     = 0x0002;
const MTP_RESPONSE = 0x0003;

const MTP_OK =
    0x2001;

const MTP_GET_DEVICE_INFO =
    0x1001;

const MTP_OPEN_SESSION =
    0x1002;

const MTP_CLOSE_SESSION =
    0x1003;

const MTP_SET_DEVICE_PROP_VALUE =
    0x1016;

const MTP_GET_STORAGE_IDS =
    0x1004;

const MTP_GET_STORAGE_INFO =
    0x1005;

const MTP_GET_DEVICE_PROP_DESC =
    0x1014;

const MTP_GET_OBJECT_PROPS_SUPPORTED =
    0x9801;

const MTP_GET_OBJECT_PROP_DESC =
    0x9802;

const MTP_OBJECT_FORMAT_UNDEFINED =
    0x3000;

const MTP_OBJECT_PROP_FILENAME =
    0xDC07;

const MTP_SEND_OBJECT_INFO =
    0x100C;

const MTP_SEND_OBJECT =
    0x100D;

const MTP_REBOOT_DEVICE =
    0x9204;

const MTP_OBJECT_FORMAT_UNDEFINED_FIRMWARE =
    0xB802;


const MTP_GET_OBJECT_HANDLES =
    0x1007;

const MTP_GET_OBJECT_INFO =
    0x1008;

const MTP_GET_OBJECT =
    0x1009;

const MTP_DELETE_OBJECT =
    0x100B;

const MTP_SET_OBJECT_PROP_VALUE =
    0x9804;

const MTP_GET_OBJECT_PROP_VALUE =
    0x9803;

const MTP_GET_OBJECT_PROP_LIST =
    0x9805;

const MTP_GET_OBJECT_REFERENCES =
    0x9810;

const MTP_SET_OBJECT_REFERENCES =
    0x9811;

const MTP_OBJECT_FORMAT_ASSOCIATION =
    0x3001;

const MTP_OBJECT_FORMAT_MP3 =
    0x3009;

const MTP_OBJECT_FORMAT_JPEG =
    0x3801;

const MTP_OBJECT_FORMAT_WMV =
    0xB981;

const MTP_OBJECT_FORMAT_ABSTRACT_AUDIO_ALBUM =
    0xBA03;

const MTP_OBJECT_FORMAT_ARTIST =
    0xB218;

const MTP_OBJECT_PROP_NAME =
    0xDC44;

const MTP_OBJECT_PROP_ARTIST =
    0xDC46;

const MTP_OBJECT_PROP_TRACK =
    0xDC8B;

const MTP_OBJECT_PROP_GENRE =
    0xDC8C;

const MTP_OBJECT_PROP_DURATION =
    0xDC89;

const MTP_OBJECT_PROP_ALBUM_NAME =
    0xDC9A;

const MTP_OBJECT_PROP_ALBUM_ARTIST =
    0xDC9B;

const MTP_OBJECT_PROP_REP_SAMPLE_FORMAT =
    0xDC81;

const MTP_OBJECT_PROP_REP_SAMPLE_SIZE =
    0xDC82;

const MTP_OBJECT_PROP_REP_SAMPLE_DATA =
    0xDC86;

const MTP_OBJECT_PROP_ARTIST_ID =
    0xDAB9;


/*
 * MTPZ vendor operations.
 */

const MTPZ_SEND_APP_REQUEST =
    0x9212;

const MTPZ_GET_APP_RESPONSE =
    0x9213;

const MTPZ_ENABLE_TRUSTED_FILES =
    0x9214;

const MTPZ_END_TRUSTED_SESSION =
    0x9216;


/*
 * MTPZ device property.
 */

const MTPZ_SESSION_INITIATOR_INFO =
    0xD406;


/*
 * ----------------------------------------------------------
 * MTPZ key material
 * ----------------------------------------------------------
 *
 * These values are the public MTPZ authentication material
 * used by the existing Zune implementations.
 *
 * They are constant for Zune devices.
 * ----------------------------------------------------------
 */

const MTPZ_MODULUS =
"cad0d4c357342dd7ad959a5029d3d316972b9b9fe234f08ba7b6bff3b522505b16f52d218c693597b2840f90807a7f77899d7454dbc2011724d45603a136682c3b4fa43a21b201ff3d8efe16cdda5ea6d225dd74c68d09b84536d3b2292beb83d1d0dbb692261eeb2ebefeb21b1836c7e19864f4198ce84fe2033fbefcd377e5";


const MTPZ_PRIVATE_KEY =
"79ee227b6da9c905a92e0f9fb205cf19fdb811cf85471e765755df00bd1cec025742fee6f46b2bf50f35a5c5d1f7d33a2259aede755fa5182ce41af203b199de2ba5cf801fcb4c8863b3c40cfdb18c9985ddad8710618802fd8969127c5f0fd52931f74a11082e27890cfbd11ae21b3611e54212d9e4269801f84d4f7e4ea601";


const MTPZ_CERTIFICATES_HEX =
"02000001350100000000b501000000010000000000000000000000000000000000125a756e6520536f6674776172652043412031000100010080336ee6aa07bfb3ffd04024cec38be6497ef60e3d7f682e0ff15e6c65ff613bde176fad7137884e80a813cf53c3101aa51b9e4f54b24fd514cdc509b6b71e1f48513df06444d9b55963e8121c4c69b67d6a1314f973c9585c29bb990ad7fd151dbbcb4f9ed7dfe292ba4ed9c6acf58e6adeef5b877a1c1545742634916946459b094b259ed85ef02b08a318e67afd68c289a8c6a61bc8023ca87fe367bdcc0856c3d15758c866e53fb52e86ec569c9c070a22174fbd7c4dcd395ec68530163451ce1f588044a06ebb95a6d4be68b089a4f25a612ffcea56c1c3f8a6880c0576f26574b64ff83d2868f0fe3696bc8425487ae062d48aadfd088a9787b806810bed000001370100000000b703000000000000000000000000000000000000000000145a756e6520536f667477617265204c6561662031000100010080e577d3fcbe3f03e24fe88c19f46498e1c736181bb2febe2eeb1e2692b6dbd0d183eb2b29b2d33645b8098dc674dd25d2a65edacd16fe8e3dff01b2213aa44f3b2c6836a10356d4241701c2db54749d89777f7a80900f84b29735698c212df5165b5022b5f3bfb6a78bf034e29f9b2b9716d3d329509a95add72d3457c3d4d0ca7eeac9776f4d73a4aafd896baa5a8685c05d5b746665218481675ed629b2553a9df03d745866c5cf240351a76c6dbbd02830e5f472e2ad24587c7cab6018fdd934c093df41cab6187e6e1ee9bb8dd599f9a210f4051fcdfd55288d9761ca22c3219e72247646ab5050b0b2c77f1dfb6f9545640361a27cafcc59f32442e21b7b";


/*
 * ----------------------------------------------------------
 * Utility functions
 * ----------------------------------------------------------
 */

function sleepMs(ms) {

    return new Promise(
        resolve => setTimeout(resolve, ms)
    );
}

function hex(value, digits = 4) {

    if (
        value === undefined ||
        value === null
    ) {
        return "Unknown";
    }

    return "0x" +
        Number(value)
            .toString(16)
            .toUpperCase()
            .padStart(digits, "0");
}


function bytesFromHex(hexString) {

    const clean =
        hexString.replace(
            /\s+/g,
            ""
        );

    const output =
        new Uint8Array(
            clean.length / 2
        );

    for (
        let i = 0;
        i < clean.length;
        i += 2
    ) {

        output[i / 2] =
            parseInt(
                clean.substring(
                    i,
                    i + 2
                ),
                16
            );
    }

    return output;
}


function concatBytes(...arrays) {

    let length = 0;

    for (
        const array of arrays
    ) {
        length += array.length;
    }

    const output =
        new Uint8Array(
            length
        );

    let offset = 0;

    for (
        const array of arrays
    ) {

        output.set(
            array,
            offset
        );

        offset +=
            array.length;
    }

    return output;
}


function bytesToHex(bytes) {

    let output = "";

    for (
        let i = 0;
        i < bytes.length;
        i++
    ) {

        output +=
            bytes[i]
                .toString(16)
                .toUpperCase()
                .padStart(2, "0");

        if (
            i !==
            bytes.length - 1
        ) {
            output += " ";
        }
    }

    return output;
}


function setStatus(
    text,
    type = ""
) {

    statusBox.textContent =
        text;

    statusBox.className =
        "status";

    if (type) {
        statusBox.classList.add(
            type
        );
    }
}


function setConnectionState(
    connected
) {

    if (connected) {

        connectionDot.classList.add(
            "connected"
        );

        connectionText.textContent =
            "Zune connected";

        connectButton.disabled =
            true;

        disconnectButton.disabled =
            false;

    } else {

        connectionDot.classList.remove(
            "connected"
        );

        connectionText.textContent =
            "Not connected";

        connectButton.disabled =
            false;

        disconnectButton.disabled =
            true;
    }
}


function logStep(
    text
) {

    if (typeof musicFastTransport !== "undefined" && musicFastTransport) {
        return;
    }

    mtpOutput.textContent +=
        "\n" +
        text;
}


/*
 * ----------------------------------------------------------
 * SHA-1
 * ----------------------------------------------------------
 */

async function sha1(
    data
) {

    const hash =
        await crypto.subtle.digest(
            "SHA-1",
            data
        );

    return new Uint8Array(
        hash
    );
}


/*
 * ----------------------------------------------------------
 * MGF1 SHA-1
 * ----------------------------------------------------------
 */

async function mgf1Sha1(
    seed,
    length
) {

    const chunks = [];

    let produced = 0;

    let counter = 0;


    while (
        produced <
        length
    ) {

        const counterBytes =
            new Uint8Array(4);

        const view =
            new DataView(
                counterBytes.buffer
            );

        view.setUint32(
            0,
            counter,
            false
        );


        const input =
            concatBytes(
                seed,
                counterBytes
            );


        const digest =
            await sha1(
                input
            );


        chunks.push(
            digest
        );


        produced +=
            digest.length;

        counter++;
    }


    const output =
        new Uint8Array(
            length
        );

    let offset = 0;


    for (
        const chunk of chunks
    ) {

        const amount =
            Math.min(
                chunk.length,
                length - offset
            );

        output.set(
            chunk.subarray(
                0,
                amount
            ),
            offset
        );

        offset += amount;

        if (
            offset >= length
        ) {
            break;
        }
    }


    return output;
}


/*
 * ----------------------------------------------------------
 * BigInt RSA
 * ----------------------------------------------------------
 */

function bytesToBigInt(
    bytes
) {

    let hexString = "";

    for (
        const byte of bytes
    ) {

        hexString +=
            byte
                .toString(16)
                .padStart(
                    2,
                    "0"
                );
    }


    return BigInt(
        "0x" +
        (
            hexString ||
            "00"
        )
    );
}


function bigIntToBytes(
    value,
    length
) {

    let hexString =
        value.toString(16);


    if (
        hexString.length %
        2 !== 0
    ) {
        hexString =
            "0" +
            hexString;
    }


    hexString =
        hexString.padStart(
            length * 2,
            "0"
        );


    const output =
        new Uint8Array(
            length
        );


    const start =
        Math.max(
            0,
            hexString.length -
            length * 2
        );


    const trimmed =
        hexString.substring(
            start
        );


    for (
        let i = 0;
        i < length;
        i++
    ) {

        output[i] =
            parseInt(
                trimmed.substring(
                    i * 2,
                    i * 2 + 2
                ),
                16
            );
    }


    return output;
}


function modPow(
    base,
    exponent,
    modulus
) {

    let result = 1n;

    base =
        base %
        modulus;


    while (
        exponent >
        0n
    ) {

        if (
            exponent &
            1n
        ) {

            result =
                (
                    result *
                    base
                ) %
                modulus;
        }


        exponent >>=
            1n;


        base =
            (
                base *
                base
            ) %
            modulus;
    }


    return result;
}


function rsaRawPrivate(
    data
) {

    const modulus =
        BigInt(
            "0x" +
            MTPZ_MODULUS
        );


    const privateKey =
        BigInt(
            "0x" +
            MTPZ_PRIVATE_KEY
        );


    const message =
        bytesToBigInt(
            data
        );


    const result =
        modPow(
            message,
            privateKey,
            modulus
        );


    return bigIntToBytes(
        result,
        128
    );
}


/*
 * ----------------------------------------------------------
 * AES-128
 *
 * Small pure-JS AES implementation used for AES-CMAC.
 * ----------------------------------------------------------
 */

const AES_SBOX = new Uint8Array([
    0x63,0x7c,0x77,0x7b,0xf2,0x6b,0x6f,0xc5,
    0x30,0x01,0x67,0x2b,0xfe,0xd7,0xab,0x76,
    0xca,0x82,0xc9,0x7d,0xfa,0x59,0x47,0xf0,
    0xad,0xd4,0xa2,0xaf,0x9c,0xa4,0x72,0xc0,
    0xb7,0xfd,0x93,0x26,0x36,0x3f,0xf7,0xcc,
    0x34,0xa5,0xe5,0xf1,0x71,0xd8,0x31,0x15,
    0x04,0xc7,0x23,0xc3,0x18,0x96,0x05,0x9a,
    0x07,0x12,0x80,0xe2,0xeb,0x27,0xb2,0x75,
    0x09,0x83,0x2c,0x1a,0x1b,0x6e,0x5a,0xa0,
    0x52,0x3b,0xd6,0xb3,0x29,0xe3,0x2f,0x84,
    0x53,0xd1,0x00,0xed,0x20,0xfc,0xb1,0x5b,
    0x6a,0xcb,0xbe,0x39,0x4a,0x4c,0x58,0xcf,
    0xd0,0xef,0xaa,0xfb,0x43,0x4d,0x33,0x85,
    0x45,0xf9,0x02,0x7f,0x50,0x3c,0x9f,0xa8,
    0x51,0xa3,0x40,0x8f,0x92,0x9d,0x38,0xf5,
    0xbc,0xb6,0xda,0x21,0x10,0xff,0xf3,0xd2,
    0xcd,0x0c,0x13,0xec,0x5f,0x97,0x44,0x17,
    0xc4,0xa7,0x7e,0x3d,0x64,0x5d,0x19,0x73,
    0x60,0x81,0x4f,0xdc,0x22,0x2a,0x90,0x88,
    0x46,0xee,0xb8,0x14,0xde,0x5e,0x0b,0xdb,
    0xe0,0x32,0x3a,0x0a,0x49,0x06,0x24,0x5c,
    0xc2,0xd3,0xac,0x62,0x91,0x95,0xe4,0x79,
    0xe7,0xc8,0x37,0x6d,0x8d,0xd5,0x4e,0xa9,
    0x6c,0x56,0xf4,0xea,0x65,0x7a,0xae,0x08,
    0xba,0x78,0x25,0x2e,0x1c,0xa6,0xb4,0xc6,
    0xe8,0xdd,0x74,0x1f,0x4b,0xbd,0x8b,0x8a,
    0x70,0x3e,0xb5,0x66,0x48,0x03,0xf6,0x0e,
    0x61,0x35,0x57,0xb9,0x86,0xc1,0x1d,0x9e,
    0xe1,0xf8,0x98,0x11,0x69,0xd9,0x8e,0x94,
    0x9b,0x1e,0x87,0xe9,0xce,0x55,0x28,0xdf,
    0x8c,0xa1,0x89,0x0d,0xbf,0xe6,0x42,0x68,
    0x41,0x99,0x2d,0x0f,0xb0,0x54,0xbb,0x16
]);


const AES_RCON = [
    0x00,
    0x01,
    0x02,
    0x04,
    0x08,
    0x10,
    0x20,
    0x40,
    0x80,
    0x1B,
    0x36
];


function aesRotWord(
    word
) {

    return [
        word[1],
        word[2],
        word[3],
        word[0]
    ];
}


function aesSubWord(
    word
) {

    return [
        AES_SBOX[word[0]],
        AES_SBOX[word[1]],
        AES_SBOX[word[2]],
        AES_SBOX[word[3]]
    ];
}


function aesExpandKey(
    key
) {

    const expanded =
        new Uint8Array(
            176
        );


    expanded.set(
        key
    );


    let bytesGenerated =
        16;

    let rconIndex =
        1;


    const temp =
        new Uint8Array(
            4
        );


    while (
        bytesGenerated <
        176
    ) {

        for (
            let i = 0;
            i < 4;
            i++
        ) {

            temp[i] =
                expanded[
                    bytesGenerated -
                    4 +
                    i
                ];
        }


        if (
            bytesGenerated %
            16 === 0
        ) {

            const rotated =
                aesRotWord(
                    temp
                );

            const subbed =
                aesSubWord(
                    rotated
                );

            temp.set(
                subbed
            );

            temp[0] ^=
                AES_RCON[
                    rconIndex++
                ];
        }


        for (
            let i = 0;
            i < 4;
            i++
        ) {

            expanded[
                bytesGenerated
            ] =
                expanded[
                    bytesGenerated -
                    16
                ] ^
                temp[i];

            bytesGenerated++;
        }
    }


    return expanded;
}


function aesGmul(
    a,
    b
) {

    let result = 0;

    for (
        let i = 0;
        i < 8;
        i++
    ) {

        if (
            b & 1
        ) {
            result ^= a;
        }


        const high =
            a & 0x80;


        a =
            (
                a << 1
            ) &
            0xFF;


        if (high) {
            a ^= 0x1B;
        }


        b >>=
            1;
    }


    return result;
}


function aesAddRoundKey(
    state,
    key,
    round
) {

    const offset =
        round * 16;


    for (
        let i = 0;
        i < 16;
        i++
    ) {

        state[i] ^=
            key[
                offset + i
            ];
    }
}


function aesSubBytes(
    state
) {

    for (
        let i = 0;
        i < 16;
        i++
    ) {

        state[i] =
            AES_SBOX[
                state[i]
            ];
    }
}


function aesShiftRows(
    state
) {

    const copy =
        state.slice();


    for (
        let row = 0;
        row < 4;
        row++
    ) {

        for (
            let col = 0;
            col < 4;
            col++
        ) {

            state[
                row +
                4 * col
            ] =
                copy[
                    row +
                    4 *
                    (
                        (
                            col +
                            row
                        ) % 4
                    )
                ];
        }
    }
}


function aesMixColumns(
    state
) {

    for (
        let col = 0;
        col < 4;
        col++
    ) {

        const i =
            col * 4;


        const a0 =
            state[i];

        const a1 =
            state[i + 1];

        const a2 =
            state[i + 2];

        const a3 =
            state[i + 3];


        state[i] =
            aesGmul(a0, 2) ^
            aesGmul(a1, 3) ^
            a2 ^
            a3;


        state[i + 1] =
            a0 ^
            aesGmul(a1, 2) ^
            aesGmul(a2, 3) ^
            a3;


        state[i + 2] =
            a0 ^
            a1 ^
            aesGmul(a2, 2) ^
            aesGmul(a3, 3);


        state[i + 3] =
            aesGmul(a0, 3) ^
            a1 ^
            a2 ^
            aesGmul(a3, 2);
    }
}


function aesEncryptBlock(
    key,
    input
) {

    const expanded =
        aesExpandKey(
            key
        );


    const state =
        input.slice();


    aesAddRoundKey(
        state,
        expanded,
        0
    );


    for (
        let round = 1;
        round <= 9;
        round++
    ) {

        aesSubBytes(
            state
        );

        aesShiftRows(
            state
        );

        aesMixColumns(
            state
        );

        aesAddRoundKey(
            state,
            expanded,
            round
        );
    }


    aesSubBytes(
        state
    );

    aesShiftRows(
        state
    );

    aesAddRoundKey(
        state,
        expanded,
        10
    );


    return state;
}


/*
 * ----------------------------------------------------------
 * AES-CMAC
 * ----------------------------------------------------------
 */

function leftShiftBlock(
    input
) {

    const output =
        new Uint8Array(
            16
        );


    let carry = 0;


    for (
        let i = 15;
        i >= 0;
        i--
    ) {

        const value =
            input[i];


        output[i] =
            (
                (
                    value << 1
                ) |
                carry
            ) &
            0xFF;


        carry =
            (
                value &
                0x80
            ) ?
            1 :
            0;
    }


    return output;
}


function aesCmac(
    key,
    data
) {

    const zero =
        new Uint8Array(
            16
        );


    const L =
        aesEncryptBlock(
            key,
            zero
        );


    const K1 =
        leftShiftBlock(
            L
        );


    if (
        L[0] &
        0x80
    ) {

        K1[15] ^=
            0x87;
    }


    const K2 =
        leftShiftBlock(
            K1
        );


    if (
        K1[0] &
        0x80
    ) {

        K2[15] ^=
            0x87;
    }


    let block;


    if (
        data.length ===
        16
    ) {

        block =
            data.slice();


        for (
            let i = 0;
            i < 16;
            i++
        ) {

            block[i] ^=
                K1[i];
        }

    } else {

        block =
            new Uint8Array(
                16
            );


        block.set(
            data
        );


        block[
            data.length
        ] =
            0x80;


        for (
            let i = 0;
            i < 16;
            i++
        ) {

            block[i] ^=
                K2[i];
        }
    }


    return aesEncryptBlock(
        key,
        block
    );
}


/*
 * ----------------------------------------------------------
 * AES-CBC decrypt
 * ----------------------------------------------------------
 *
 * WebCrypto's AES-CBC implementation is used here because
 * the MTPZ device response is AES-128-CBC encrypted.
 * ----------------------------------------------------------
 */

async function aesCbcDecrypt(
    key,
    ciphertext
) {

    if (
        ciphertext.length === 0 ||
        ciphertext.length % 16 !== 0
    ) {

        throw new Error(
            "MTPZ AES ciphertext must be a non-empty multiple of 16 bytes."
        );
    }


    const cryptoKey =
        await crypto.subtle.importKey(
            "raw",
            key,
            {
                name: "AES-CBC"
            },
            false,
            ["encrypt", "decrypt"]
        );


    const iv =
        new Uint8Array(
            16
        );


    /*
     * MTPZ uses AES-128-CBC without PKCS#7 padding. WebCrypto
     * does not expose a no-padding option for AES-CBC, so make
     * one synthetic final CBC block whose plaintext is a valid
     * full padding block (16 bytes of 0x10). The real plaintext
     * blocks remain unchanged; WebCrypto then strips only the
     * synthetic padding block during decryption.
     */

    const paddingPlaintext =
        new Uint8Array(
            16
        );

    paddingPlaintext.fill(
        16
    );


    const lastCiphertextBlock =
        ciphertext.slice(
            ciphertext.length - 16
        );


    const syntheticEncryption =
        new Uint8Array(
            await crypto.subtle.encrypt(
                {
                    name: "AES-CBC",
                    iv: lastCiphertextBlock
                },
                cryptoKey,
                paddingPlaintext
            )
        );


    const syntheticPaddingCiphertext =
        syntheticEncryption.slice(
            0,
            16
        );


    const paddedCiphertext =
        new Uint8Array(
            ciphertext.length +
            16
        );


    paddedCiphertext.set(
        ciphertext,
        0
    );

    paddedCiphertext.set(
        syntheticPaddingCiphertext,
        ciphertext.length
    );


    const decrypted =
        new Uint8Array(
            await crypto.subtle.decrypt(
                {
                    name: "AES-CBC",
                    iv
                },
                cryptoKey,
                paddedCiphertext
            )
        );


    return decrypted;
}


/*
 * ----------------------------------------------------------
 * MTP container building
 * ----------------------------------------------------------
 */

function buildMtpCommand(
    code,
    tx,
    params = []
) {

    const buffer =
        new ArrayBuffer(
            12 +
            params.length * 4
        );


    const view =
        new DataView(
            buffer
        );


    view.setUint32(
        0,
        buffer.byteLength,
        true
    );


    view.setUint16(
        4,
        MTP_COMMAND,
        true
    );


    view.setUint16(
        6,
        code,
        true
    );


    view.setUint32(
        8,
        tx,
        true
    );


    for (
        let i = 0;
        i < params.length;
        i++
    ) {

        view.setUint32(
            12 +
            i * 4,
            params[i] >>> 0,
            true
        );
    }


    return new Uint8Array(
        buffer
    );
}


function buildMtpDataHeader(
    code,
    tx,
    length
) {

    const buffer =
        new ArrayBuffer(
            12
        );


    const view =
        new DataView(
            buffer
        );


    view.setUint32(
        0,
        12 + length,
        true
    );


    view.setUint16(
        4,
        MTP_DATA,
        true
    );


    view.setUint16(
        6,
        code,
        true
    );


    view.setUint32(
        8,
        tx,
        true
    );


    return new Uint8Array(
        buffer
    );
}


/*
 * ----------------------------------------------------------
 * USB transport
 * ----------------------------------------------------------
 */

/*
 * WebUSB transport runs without an application-level timeout.
 * This is intentional for Zune/MTPZ devices because some operations
 * can take longer than a fixed timeout window.
 */

function logUsbTraffic(
    direction,
    bytes
) {

    if (typeof musicFastTransport !== "undefined" && musicFastTransport) {
        return;
    }

    if (!rawResponse) {
        return;
    }


    const shown =
        bytes.slice(
            0,
            Math.min(
                bytes.length,
                256
            )
        );


    rawResponse.textContent =
        direction +
        " " +
        bytes.length +
        " bytes\n" +
        bytesToHex(
            shown
        ) +
        (
            bytes.length > 256
                ? "\n... truncated ..."
                : ""
        );
}


async function bulkWrite(
    bytes
) {

    if (!zuneDevice) {
        throw new Error(
            "USB device is not connected."
        );
    }


    logUsbTraffic(
        "OUT",
        bytes
    );


    logStep(
        "USB OUT: endpoint " +
        mtpBulkOutEndpoint +
        ", " +
        bytes.length +
        " bytes."
    );


    const result =
        await zuneDevice.transferOut(
            mtpBulkOutEndpoint,
            bytes
        );


    if (
        result.status !==
        "ok"
    ) {

        throw new Error(
            "USB bulk OUT failed: " +
            result.status
        );
    }


    logStep(
        "USB OUT: transfer completed successfully."
    );
}


async function bulkRead(
    length
) {

    if (!zuneDevice) {
        throw new Error(
            "USB device is not connected."
        );
    }


    logStep(
        "USB IN: waiting for up to " +
        length +
        " bytes..."
    );


    const result =
        await zuneDevice.transferIn(
            mtpBulkInEndpoint,
            length
        );


    if (
        result.status !==
        "ok"
    ) {

        throw new Error(
            "USB bulk IN failed: " +
            result.status
        );
    }


    if (
        !result.data
    ) {

        return new Uint8Array(
            0
        );
    }


    const bytes =
        new Uint8Array(
            result.data.buffer,
            result.data.byteOffset,
            result.data.byteLength
        );


    logStep(
        "USB IN: received " +
        bytes.length +
        " bytes."
    );


    return bytes;
}


async function receiveContainer() {

    /*
     * Match the working desktop implementation:
     *
     *   1. Start with a 512-byte bulk read.
     *   2. Read only the number of bytes still needed.
     *
     * This is more reliable with the Zune 30 than requesting
     * a 16 KiB packet for the first read.
     */

    /*
     * The Zune 30 advertises a 64-byte bulk packet size. Reading one
     * packet at a time avoids a ChromeOS/WebUSB quirk where a 512-byte
     * IN request can remain pending when this old responder only has a
     * short packet ready. receiveContainer() will continue reading until
     * the MTP container's declared length has been collected.
     */
    const firstReadLength =
        Math.max(
            mtpBulkInPacketSize || 64,
            512
        );

    const firstChunk =
        await bulkRead(
            firstReadLength
        );


    if (
        firstChunk.length <
        4
    ) {

        throw new Error(
            "USB response was shorter than the 4-byte MTP length field."
        );
    }


    const firstView =
        new DataView(
            firstChunk.buffer,
            firstChunk.byteOffset,
            firstChunk.byteLength
        );


    const expectedLength =
        firstView.getUint32(
            0,
            true
        );


    if (
        expectedLength <
        12
    ) {

        throw new Error(
            "Invalid MTP container length: " +
            expectedLength
        );
    }


    if (
        expectedLength >
        4 * 1024 * 1024
    ) {

        throw new Error(
            "MTP container is unreasonably large: " +
            expectedLength +
            " bytes."
        );
    }


    if (
        firstChunk.length >=
        expectedLength
    ) {

        return firstChunk.slice(
            0,
            expectedLength
        );
    }


    const chunks = [
        firstChunk
    ];


    let received =
        firstChunk.length;


    while (
        received <
        expectedLength
    ) {

        const remaining =
            expectedLength -
            received;


        /*
         * Always request a full USB bulk packet from the Zune instead of
         * requesting exactly the remaining MTP bytes. The Zune 30's old
         * USB stack can return an empty transfer when the requested length
         * is smaller than its 64-byte endpoint packet size, even though
         * the final short MTP packet is ready.
         *
         * Never read past the MTP container: we stop as soon as the
         * declared container length has been collected.
         */
        const chunk =
            await bulkRead(
                Math.max(
                    mtpBulkInPacketSize || 64,
                    64
                )
            );


        if (
            chunk.length ===
            0
        ) {

            throw new Error(
                "Zune returned an empty USB packet while the MTP container was incomplete."
            );
        }


        chunks.push(
            chunk
        );


        received +=
            chunk.length;
    }


    return concatBytes(
        ...chunks
    ).slice(
        0,
        expectedLength
    );
}


function parseContainer(
    bytes
) {

    if (
        bytes.length <
        12
    ) {

        throw new Error(
            "MTP container is too short."
        );
    }


    const view =
        new DataView(
            bytes.buffer,
            bytes.byteOffset,
            bytes.byteLength
        );


    const length =
        view.getUint32(
            0,
            true
        );


    const type =
        view.getUint16(
            4,
            true
        );


    const code =
        view.getUint16(
            6,
            true
        );


    const tx =
        view.getUint32(
            8,
            true
        );


    const parameters = [];

    if (type === MTP_RESPONSE) {
        for (let offset = 12; offset + 4 <= length; offset += 4) {
            parameters.push(
                view.getUint32(offset, true)
            );
        }
    }

    return {

        length,

        type,

        code,

        transactionId:
            tx,

        parameters,

        payload:
            bytes.slice(
                12,
                length
            )
    };
}


async function receiveResponse() {

    const bytes =
        await receiveContainer();

    lastReceivedContainerBytes = bytes;

    rawResponse.textContent =
        bytesToHex(
            bytes
        );


    const container =
        parseContainer(
            bytes
        );


    if (
        container.type !==
        MTP_RESPONSE
    ) {

        throw new Error(
            "Expected MTP response but received container type " +
            hex(
                container.type
            )
        );
    }


    if (
        container.code !==
        MTP_OK
    ) {

        lastMtpErrorResponse =
            bytes.slice();

        throw new Error(
            "MTP response " +
            hex(
                container.code
            )
        );
    }


    return container;
}


async function sendCommand(
    code,
    params = []
) {

    transactionId++;


    const command =
        buildMtpCommand(
            code,
            transactionId,
            params
        );


    await bulkWrite(
        command
    );
}


async function sendData(
    code,
    tx,
    payload,
    options = {}
) {

    const separateTransfers =
        options.combine === false;

    const header =
        buildMtpDataHeader(
            code,
            tx,
            payload.length
        );

    /*
     * Zune-specific MTP behavior:
     *
     * Working Zune implementations send a DATA container as two
     * separate USB bulk transfers:
     *
     *   1. 12-byte MTP DATA header
     *   2. DATA payload
     *
     * The container is still one logical MTP DATA packet; only the
     * USB transfer boundary is split. This is particularly important
     * for the Zune MTPZ application-request packet.
     *
     * A current pure-JavaScript Zune implementation uses this exact
     * arrangement because the Zune requires DATA headers and payloads
     * as separate USB transfers.
     *
     * Firmware recovery also uses split transfers, with larger payload
     * chunks, so preserve its existing behavior below.
     */

    if (!separateTransfers) {
        logStep(
            "MTP DATA phase: sending 12-byte DATA header as a separate USB transfer."
        );

        await bulkWrite(
            header
        );

        /*
         * Send the payload as one logical USB bulk transfer when it fits
         * comfortably within the device/host transfer path. WebUSB will
         * packetize this at the endpoint's maximum packet size.
         */
        logStep(
            "MTP DATA phase: sending " +
            payload.length +
            "-byte payload as a separate USB transfer."
        );

        await bulkWrite(
            payload
        );

        return;
    }

    /* Firmware-recovery-specific split DATA transfer. */
    logStep(
        "MTP DATA phase: sending 12-byte data header as a separate USB transfer."
    );

    await bulkWrite(
        header
    );

    const chunkSize =
        16384;

    for (
        let offset = 0;
        offset < payload.length;
        offset += chunkSize
    ) {
        const chunk =
            payload.slice(
                offset,
                Math.min(
                    offset + chunkSize,
                    payload.length
                )
            );

        logStep(
            "MTP DATA phase: sending " +
            chunk.length +
            "-byte payload as a separate USB transfer."
        );

        await bulkWrite(
            chunk
        );
    }
}


/*
 * ----------------------------------------------------------
 * MTP session
 * ----------------------------------------------------------
 */

async function openMtpSession() {

    logStep(
        "Opening MTP session..."
    );


    /*
     * OpenSession must use transaction ID 0.
     */

    transactionId = 0;


    const command =
        buildMtpCommand(
            MTP_OPEN_SESSION,
            0,
            [1]
        );


    await bulkWrite(
        command
    );


    await receiveResponse();


    transactionId = 0;

    sessionOpen = true;


    logStep(
        "MTP session opened."
    );
}


async function closeMtpSession() {

    if (
        !sessionOpen
    ) {

        return;
    }


    const diagnosticResponse =
        lastMtpErrorResponse
            ? lastMtpErrorResponse.slice()
            : null;

    try {

        transactionId++;


        await bulkWrite(
            buildMtpCommand(
                MTP_CLOSE_SESSION,
                transactionId
            )
        );


        await receiveResponse();

    } catch (error) {

        console.warn(
            "MTP close session:",
            error
        );

    } finally {

        sessionOpen =
            false;

        if (diagnosticResponse) {
            rawResponse.textContent =
                bytesToHex(diagnosticResponse);
        }
    }
}


/*
 * ----------------------------------------------------------
 * MTP string
 * ----------------------------------------------------------
 */

function encodeMtpString(
    value
) {

    const text =
        String(value) +
        "\0";


    const output =
        new Uint8Array(
            1 +
            text.length * 2
        );


    output[0] =
        text.length;


    const view =
        new DataView(
            output.buffer
        );


    for (
        let i = 0;
        i < text.length;
        i++
    ) {

        view.setUint16(
            1 +
            i * 2,
            text.charCodeAt(i),
            true
        );
    }


    return output;
}


function decodeMtpString(
    view,
    offset
) {

    if (
        offset >=
        view.byteLength
    ) {

        return {
            value: "",
            offset
        };
    }


    const count =
        view.getUint8(
            offset
        );


    offset++;


    if (
        count ===
        0
    ) {

        return {
            value: "",
            offset
        };
    }


    let value = "";


    for (
        let i = 0;
        i < count - 1;
        i++
    ) {

        value +=
            String.fromCharCode(
                view.getUint16(
                    offset +
                    i * 2,
                    true
                )
            );
    }


    return {

        value,

        offset:
            offset +
            count * 2
    };
}


/*
 * ----------------------------------------------------------
 * Set SessionInitiatorInfo
 * ----------------------------------------------------------
 */

async function setSessionInitiatorInfo() {

    logStep(
        "MTPZ step 1: setting SessionInitiatorInfo..."
    );


    transactionId++;


    const tx =
        transactionId;


    logStep(
        "MTPZ step 1 transaction ID: " +
        tx
    );


    const command =
        buildMtpCommand(
            MTP_SET_DEVICE_PROP_VALUE,
            tx,
            [
                MTPZ_SESSION_INITIATOR_INFO
            ]
        );


    /*
     * SetDevicePropValue must contain the property code as
     * its first parameter, so this command is 16 bytes:
     * 12-byte MTP header + 4-byte property code.
     *
     * Keep the check here because a malformed 12-byte command
     * can make the Zune stop responding at this exact stage.
     */
    if (command.length !== 16) {
        throw new Error(
            "MTPZ step 1 generated an invalid SetDevicePropValue command: " +
            command.length +
            " bytes; expected 16."
        );
    }


    logStep(
        "MTPZ step 1 command: 16 bytes (SetDevicePropValue, property 0xD406)."
    );


    await bulkWrite(
        command
    );


    const payload =
        encodeMtpString(
            "libmtp/Sajid Anwar - MTPZClassDriver"
        );


    logStep(
        "MTPZ step 1 data payload: " +
        payload.length +
        " bytes."
    );


    await sendData(
        MTP_SET_DEVICE_PROP_VALUE,
        tx,
        payload
    );


    logStep(
        "MTPZ step 1: waiting for Zune response..."
    );


    let response = null;

    try {
        response =
            await receiveResponse();
    } catch (error) {
        /*
         * Zune's original Windows MTPZ handshake intentionally sends
         * SessionInitiatorInfo even though the Zune can answer that
         * SetDevicePropValue with 0x2002 (GeneralError).  The captured
         * Zune handshake continues with EndTrustedAppSession after this
         * response instead of treating 0x2002 as a fatal transport error.
         *
         * This is also documented by the original MTPZ packet analysis:
         * transaction 2 is SetDevicePropValue/D406 and the responder can
         * reject that property while the authentication handshake proceeds.
         * Do not retry the property write or change the transaction ID.
         */
        if (
            lastMtpErrorResponse &&
            lastMtpErrorResponse.length >= 12
        ) {
            const errorView =
                new DataView(
                    lastMtpErrorResponse.buffer,
                    lastMtpErrorResponse.byteOffset,
                    lastMtpErrorResponse.byteLength
                );

            const errorCode =
                errorView.getUint16(
                    6,
                    true
                );

            const errorTx =
                errorView.getUint32(
                    8,
                    true
                );

            if (
                errorCode === 0x2002 &&
                errorTx === tx
            ) {
                logStep(
                    "Zune returned 0x2002 (GeneralError) for SessionInitiatorInfo. " +
                    "This is tolerated by the Zune MTPZ handshake; continuing."
                );

                response = null;
            } else {
                throw error;
            }
        } else {
            throw error;
        }
    }


    if (
        response &&
        response.transactionId !==
        tx
    ) {

        throw new Error(
            "MTPZ step 1 transaction mismatch. " +
            "Expected " +
            tx +
            ", received " +
            response.transactionId +
            "."
        );
    }


    logStep(
        "MTPZ step 1 complete."
    );
}


/*
 * ----------------------------------------------------------
 * Reset MTPZ handshake
 * ----------------------------------------------------------
 */

async function receiveDataAndResponse(expectedCode, expectedTx) {

    const dataBytes =
        await receiveContainer();

    lastReceivedContainerBytes =
        dataBytes;

    rawResponse.textContent =
        bytesToHex(
            dataBytes
        );

    const data =
        parseContainer(
            dataBytes
        );

    if (
        data.type !==
        MTP_DATA
    ) {

        throw new Error(
            "Expected MTP DATA container, received " +
            hex(data.type)
        );
    }

    if (
        data.code !==
        expectedCode
    ) {

        throw new Error(
            "Unexpected DATA operation " +
            hex(data.code) +
            "; expected " +
            hex(expectedCode)
        );
    }

    if (
        data.transactionId !==
        expectedTx
    ) {

        throw new Error(
            "DATA transaction mismatch. Expected " +
            expectedTx +
            ", received " +
            data.transactionId
        );
    }

    await receiveResponse();

    return data.payload;
}


async function sendCommandExpectData(code, params = []) {

    transactionId++;

    const tx =
        transactionId;

    await bulkWrite(
        buildMtpCommand(
            code,
            tx,
            params
        )
    );

    return {
        tx,
        payload:
            await receiveDataAndResponse(
                code,
                tx
            )
    };
}


/*
 * The original Zune MTPZ trace performs several normal MTP
 * queries before the trusted-session reset and application
 * certificate exchange. The previous browser implementation
 * jumped directly from transaction 2 to EndTrustedAppSession,
 * causing the certificate request to be rejected with 0x2002.
 *
 * Historical transaction sequence:
 *   3  GetDevicePropDesc
 *   4  GetDevicePropDesc
 *   5  GetObjectPropsSupported
 *   6  GetObjectPropDesc
 *   7  GetStorageIDs
 *   8  GetStorageInfo
 *   9  EndTrustedAppSession
 *   10 EndTrustedAppSession
 *   11 EndTrustedAppSession
 */
async function resetMtpzHandshake() {

    logStep(
        "MTPZ step 2: preparing Zune handshake state..."
    );

    logStep(
        "MTPZ setup tx3: reading device property 0xD401..."
    );

    await sendCommandExpectData(
        MTP_GET_DEVICE_PROP_DESC,
        [0xD401]
    );

    logStep(
        "MTPZ setup tx4: reading device property 0xD402..."
    );

    await sendCommandExpectData(
        MTP_GET_DEVICE_PROP_DESC,
        [0xD402]
    );

    logStep(
        "MTPZ setup tx5: reading object properties supported..."
    );

    await sendCommandExpectData(
        MTP_GET_OBJECT_PROPS_SUPPORTED,
        [MTP_OBJECT_FORMAT_UNDEFINED]
    );

    logStep(
        "MTPZ setup tx6: reading filename property description..."
    );

    await sendCommandExpectData(
        MTP_GET_OBJECT_PROP_DESC,
        [
            MTP_OBJECT_PROP_FILENAME,
            MTP_OBJECT_FORMAT_UNDEFINED
        ]
    );

    logStep(
        "MTPZ setup tx7: reading storage IDs..."
    );

    const storageResult =
        await sendCommandExpectData(
            MTP_GET_STORAGE_IDS
        );

    if (
        storageResult.payload.length < 8
    ) {

        throw new Error(
            "Zune returned an invalid storage ID list during MTPZ setup."
        );
    }

    const storageView =
        new DataView(
            storageResult.payload.buffer,
            storageResult.payload.byteOffset,
            storageResult.payload.byteLength
        );

    const storageCount =
        storageView.getUint32(
            0,
            true
        );

    if (
        storageCount < 1
    ) {

        throw new Error(
            "Zune reported no storage during MTPZ setup."
        );
    }

    const storageId =
        storageView.getUint32(
            4,
            true
        );

    logStep(
        "MTPZ setup tx8: reading storage information for " +
        hex(storageId, 8) +
        "..."
    );

    await sendCommandExpectData(
        MTP_GET_STORAGE_INFO,
        [storageId]
    );

    logStep(
        "MTPZ setup tx9-11: resetting trusted application session..."
    );

    for (
        let i = 0;
        i < 3;
        i++
    ) {

        transactionId++;

        const tx =
            transactionId;

        await bulkWrite(
            buildMtpCommand(
                MTPZ_END_TRUSTED_SESSION,
                tx
            )
        );

        await receiveResponse();
    }

    // Match the timing used by the original Zune client closely enough
    // for the Zune 30's older trusted-session state machine.
    await sleepMs(50);

    logStep(
        "MTPZ step 2 complete."
    );
}


/*
 * ----------------------------------------------------------
 * Build application certificate message
 * ----------------------------------------------------------
 */

async function mtpzHashCustom6A5DC(messageBytes, outputLength) {

    const count =
        Math.floor(outputLength / 20) +
        1;

    const output =
        new Uint8Array(
            count * 20
        );

    for (
        let i = 0;
        i < count;
        i++
    ) {

        const input =
            new Uint8Array(
                messageBytes.length + 4
            );

        input.set(
            messageBytes,
            0
        );

        const view =
            new DataView(
                input.buffer
            );

        // MTPZ uses MTPZ_SWAP(i), i.e. a big-endian
        // 32-bit counter appended to the message.
        view.setUint32(
            messageBytes.length,
            i,
            false
        );

        const digest =
            await sha1(
                input
            );

        output.set(
            digest,
            i * 20
        );
    }

    return output;
}


async function buildApplicationCertificateMessage() {

    const certificates =
        bytesFromHex(
            MTPZ_CERTIFICATES_HEX
        );

    if (
        certificates.length !==
        0x275
    ) {

        throw new Error(
            "Invalid MTPZ certificate data length: " +
            certificates.length +
            " bytes; expected 629."
        );
    }


    const random =
        crypto.getRandomValues(
            new Uint8Array(
                16
            )
        );


    // Exact Windows/libmtp ACM layout:
    //   02 01
    //   01 00 00 02 75
    //   certificate data (0x275 bytes)
    //   00 10
    //   random (16 bytes)
    //   01 00 80
    //   RSA signature (128 bytes)
    const preSignLength =
        2 +
        5 +
        certificates.length +
        2 +
        random.length;


    const totalLength =
        preSignLength +
        3 +
        128;


    const message =
        new Uint8Array(
            totalLength
        );


    let offset = 0;


    message[offset++] =
        0x02;

    message[offset++] =
        0x01;

    message[offset++] =
        0x01;

    message[offset++] =
        0x00;

    message[offset++] =
        0x00;

    message[offset++] =
        0x02;

    message[offset++] =
        0x75;


    message.set(
        certificates,
        offset
    );

    offset +=
        certificates.length;


    message[offset++] =
        0x00;

    message[offset++] =
        0x10;

    message.set(
        random,
        offset
    );

    offset +=
        random.length;


    if (
        offset !==
        preSignLength
    ) {

        throw new Error(
            "Internal MTPZ ACM length error."
        );
    }


    /*
     * MTPZ ACM signature generation is NOT simply:
     *     SHA1(SHA1(message))
     * and it is not RSA-PSS/MGF1.
     *
     * The original libmtp implementation does this:
     *
     *   1. SHA1(message starting at byte 2)
     *   2. Put that 20-byte digest at offset 8 of a
     *      zero-filled 28-byte buffer.
     *   3. SHA1 the complete 28-byte buffer.
     *   4. Build the 128-byte RSA block with the 20-byte
     *      digest at offset 107 and byte 106 = 0x01.
     *   5. Generate 107 bytes of masking data using
     *      SHA1(hash || big-endian counter), then XOR it
     *      over bytes 0..106.
     *   6. Clear the high bit of byte 0 and set byte 127
     *      to 0xBC.
     *   7. RSA private-key operation over the complete
     *      128-byte block.
     *
     * This matches the published libmtp MTPZ implementation.
     */

    const firstHash =
        await sha1(
            message.slice(
                2,
                preSignLength
            )
        );


    const hashInput =
        new Uint8Array(
            28
        );

    hashInput.set(
        firstHash,
        8
    );


    const hash =
        await sha1(
            hashInput
        );


    const mask =
        await mtpzHashCustom6A5DC(
            hash,
            107
        );


    const padded =
        new Uint8Array(
            128
        );

    padded[106] =
        0x01;

    padded.set(
        hash,
        107
    );


    for (
        let i = 0;
        i < 107;
        i++
    ) {

        padded[i] ^=
            mask[i];
    }


    padded[0] &=
        0x7F;

    padded[127] =
        0xBC;


    const signature =
        rsaRawPrivate(
            padded
        );


    message[offset++] =
        0x01;

    message[offset++] =
        0x00;

    message[offset++] =
        0x80;

    message.set(
        signature,
        offset
    );


    return {
        message,
        random
    };
}



/*
 * ----------------------------------------------------------
 * Send MTPZ application request
 * ----------------------------------------------------------
 */

async function sendMtpzRequest(
    data
) {

    transactionId++;


    const tx =
        transactionId;


    await bulkWrite(
        buildMtpCommand(
            MTPZ_SEND_APP_REQUEST,
            tx
        )
    );


    await sendData(
        MTPZ_SEND_APP_REQUEST,
        tx,
        data
    );


    await receiveResponse();
}


/*
 * ----------------------------------------------------------
 * Get MTPZ device response
 * ----------------------------------------------------------
 */

async function getMtpzResponse() {

    transactionId++;


    const tx =
        transactionId;


    await bulkWrite(
        buildMtpCommand(
            MTPZ_GET_APP_RESPONSE,
            tx
        )
    );


    const dataContainer =
        await receiveContainer();


    const data =
        parseContainer(
            dataContainer
        );


    rawResponse.textContent =
        bytesToHex(
            dataContainer
        );


    if (
        data.type !==
        MTP_DATA
    ) {

        throw new Error(
            "MTPZ expected a DATA response but received " +
            hex(
                data.type
            )
        );
    }


    await receiveResponse();


    return data.payload;
}


/*
 * ----------------------------------------------------------
 * Parse and decrypt device challenge
 * ----------------------------------------------------------
 */

async function parseDeviceResponse(
    response,
    sentRandom
) {

    if (
        response.length <
        136
    ) {

        throw new Error(
            "MTPZ device response is too short."
        );
    }


    if (
        response[0] !== 0x02 ||
        response[1] !== 0x02 ||
        response[3] !== 0x80
    ) {

        throw new Error(
            "Unexpected MTPZ device response header: " +
            bytesToHex(
                response.slice(
                    0,
                    8
                )
            )
        );
    }


    logStep(
        "Decrypting device RSA challenge..."
    );


    const encrypted =
        response.slice(
            4,
            132
        );


    const decrypted =
        rsaRawPrivate(
            encrypted
        );


    /*
     * MTPZ uses its custom 6A5DC SHA-1 mask generator here,
     * not standard RSA-OAEP MGF1. This matches the published
     * libmtp handshake implementation exactly.
     */

    const seedMask =
        await mtpzHashCustom6A5DC(
            decrypted.slice(
                21,
                128
            ),
            20
        );


    for (
        let i = 0;
        i < 20;
        i++
    ) {

        decrypted[
            1 + i
        ] ^=
            seedMask[i];
    }


    const dataMask =
        await mtpzHashCustom6A5DC(
            decrypted.slice(
                1,
                21
            ),
            107
        );


    for (
        let i = 0;
        i < 107;
        i++
    ) {

        decrypted[
            21 + i
        ] ^=
            dataMask[i];
    }


    /*
     * AES session key.
     */

    const hashKey =
        decrypted.slice(
            112,
            128
        );


    const responseView =
        new DataView(
            response.buffer,
            response.byteOffset,
            response.byteLength
        );


    const aesBlockLength =
        responseView.getUint16(
            134,
            false
        );


    if (
        aesBlockLength ===
        0 ||
        aesBlockLength %
            16 !==
        0
    ) {

        throw new Error(
            "Invalid MTPZ AES block length: " +
            aesBlockLength
        );
    }


    const ciphertext =
        response.slice(
            136,
            136 +
            aesBlockLength
        );


    logStep(
        "Decrypting device AES payload..."
    );


    const plaintext =
        await aesCbcDecrypt(
            hashKey,
            ciphertext
        );


    /*
     * Parse payload.
     */

    let offset = 1;


    if (
        offset + 4 >
        plaintext.length
    ) {

        throw new Error(
            "Invalid MTPZ plaintext."
        );
    }


    const plainView =
        new DataView(
            plaintext.buffer,
            plaintext.byteOffset,
            plaintext.byteLength
        );


    const certificateLength =
        plainView.getUint32(
            offset,
            false
        );


    offset += 4;


    offset +=
        certificateLength;


    const randomLength =
        plainView.getUint16(
            offset,
            false
        );


    offset += 2;


    const echoedRandom =
        plaintext.slice(
            offset,
            offset +
            randomLength
        );


    offset +=
        randomLength;


    if (
        echoedRandom.length !==
        sentRandom.length
    ) {

        throw new Error(
            "MTPZ echoed random has the wrong length."
        );
    }


    for (
        let i = 0;
        i < sentRandom.length;
        i++
    ) {

        if (
            echoedRandom[i] !==
            sentRandom[i]
        ) {

            throw new Error(
                "MTPZ device did not echo our random value."
            );
        }
    }


    logStep(
        "Device challenge verified."
    );


    /*
     * Skip device random.
     */

    const deviceRandomLength =
        plainView.getUint16(
            offset,
            false
        );


    offset +=
        2 +
        deviceRandomLength;


    /*
     * Skip signature block.
     */

    offset += 1;


    const signatureLength =
        plainView.getUint16(
            offset,
            false
        );


    offset +=
        2 +
        signatureLength;


    /*
     * MAC hash.
     */

    offset += 1;


    const macHashLength =
        plainView.getUint16(
            offset,
            false
        );


    offset += 2;


    const macHash =
        plaintext.slice(
            offset,
            offset +
            macHashLength
        );


    if (
        macHash.length ===
        0
    ) {

        throw new Error(
            "MTPZ device did not provide a MAC hash."
        );
    }


    return {
        macHash
    };
}


/*
 * ----------------------------------------------------------
 * MTPZ confirmation
 * ----------------------------------------------------------
 */

function buildMtpzConfirmation(
    macHash
) {

    const confirmation =
        new Uint8Array(
            20
        );


    confirmation[0] =
        0x02;

    confirmation[1] =
        0x03;

    confirmation[2] =
        0x00;

    confirmation[3] =
        0x10;


    const seed =
        new Uint8Array(
            16
        );


    seed[15] =
        0x01;


    const cmacKey =
        macHash.slice(
            0,
            16
        );


    const cmac =
        aesCmac(
            cmacKey,
            seed
        );


    confirmation.set(
        cmac,
        4
    );


    return confirmation;
}


/*
 * ----------------------------------------------------------
 * Enable trusted file operations
 * ----------------------------------------------------------
 */

async function enableTrustedFileOperations(
    macHash
) {

    if (
        macHash.length <
        20
    ) {

        throw new Error(
            "MTPZ MAC hash is too short."
        );
    }


    const cmacKey =
        macHash.slice(
            0,
            16
        );


    const macCount =
        macHash.slice(
            16,
            20
        );


    const cmac =
        aesCmac(
            cmacKey,
            macCount
        );


    const view =
        new DataView(
            cmac.buffer,
            cmac.byteOffset,
            cmac.byteLength
        );


    const h1 =
        view.getUint32(
            0,
            false
        );


    const h2 =
        view.getUint32(
            4,
            false
        );


    const h3 =
        view.getUint32(
            8,
            false
        );


    const h4 =
        view.getUint32(
            12,
            false
        );


    logStep(
        "MTPZ step 6: enabling trusted file operations..."
    );


    transactionId++;


    await bulkWrite(
        buildMtpCommand(
            MTPZ_ENABLE_TRUSTED_FILES,
            transactionId,
            [
                h1,
                h2,
                h3,
                h4
            ]
        )
    );


    await receiveResponse();


    logStep(
        "Trusted file operations enabled."
    );
}


/*
 * ----------------------------------------------------------
 * Complete MTPZ authentication
 * ----------------------------------------------------------
 */

async function authenticateMtpz() {

    mtpOutput.textContent =
        "";


    /*
     * Step 1.
     */

    await setSessionInitiatorInfo();


    /*
     * Step 2.
     */

    await resetMtpzHandshake();


    /*
     * Step 3.
     */

    logStep(
        "MTPZ step 3: building application certificate..."
    );


    const {
        message,
        random
    } =
        await buildApplicationCertificateMessage();


    logStep(
        "Certificate message: " +
        message.length +
        " bytes."
    );


    await sendMtpzRequest(
        message
    );


    logStep(
        "MTPZ step 3 complete."
    );


    /*
     * Step 4.
     */

    logStep(
        "MTPZ step 4: requesting device challenge..."
    );


    const response =
        await getMtpzResponse();


    const {
        macHash
    } =
        await parseDeviceResponse(
            response,
            random
        );


    logStep(
        "MTPZ step 4 complete."
    );


    /*
     * Step 5.
     */

    logStep(
        "MTPZ step 5: sending CMAC confirmation..."
    );


    const confirmation =
        buildMtpzConfirmation(
            macHash
        );


    await sendMtpzRequest(
        confirmation
    );


    logStep(
        "MTPZ step 5 complete."
    );


    /*
     * Step 6.
     */

    await enableTrustedFileOperations(
        macHash
    );


    return true;
}


/*
 * ----------------------------------------------------------
 * Get DeviceInfo
 * ----------------------------------------------------------
 */

async function getDeviceInfo() {

    transactionId++;


    const tx =
        transactionId;


    logStep(
        "Requesting GetDeviceInfo..."
    );


    await bulkWrite(
        buildMtpCommand(
            MTP_GET_DEVICE_INFO,
            tx
        )
    );


    const dataBytes =
        await receiveContainer();


    const data =
        parseContainer(
            dataBytes
        );


    rawResponse.textContent =
        bytesToHex(
            dataBytes
        );


    if (
        data.type !==
        MTP_DATA
    ) {

        throw new Error(
            "GetDeviceInfo did not return a DATA container."
        );
    }


    const response =
        await receiveResponse();


    if (
        response.transactionId !==
        tx
    ) {

        throw new Error(
            "MTP transaction ID mismatch."
        );
    }


    const info =
        parseDeviceInfo(
            data.payload
        );


    displayDeviceInfo(
        info
    );


    return info;
}


/*
 * ----------------------------------------------------------
 * Parse DeviceInfo
 * ----------------------------------------------------------
 */

function parseDeviceInfo(
    bytes
) {

    const view =
        new DataView(
            bytes.buffer,
            bytes.byteOffset,
            bytes.byteLength
        );


    let offset = 0;


    function readU16() {

        const value =
            view.getUint16(
                offset,
                true
            );

        offset += 2;

        return value;
    }


    function readU32() {

        const value =
            view.getUint32(
                offset,
                true
            );

        offset += 4;

        return value;
    }


    function readArray() {

        const count =
            readU32();


        const values = [];


        for (
            let i = 0;
            i < count;
            i++
        ) {

            values.push(
                readU16()
            );
        }


        return values;
    }


    function readString() {

        const result =
            decodeMtpString(
                view,
                offset
            );


        offset =
            result.offset;


        return result.value;
    }


    const standardVersion =
        readU16();


    const vendorExtensionId =
        readU32();


    const vendorExtensionVersion =
        readU16();


    const vendorExtensionDescription =
        readString();


    const functionalMode =
        readU16();


    const operations =
        readArray();


    const events =
        readArray();


    const deviceProperties =
        readArray();


    const captureFormats =
        readArray();


    const imageFormats =
        readArray();


    const manufacturer =
        readString();


    const model =
        readString();


    const deviceVersion =
        readString();


    const serialNumber =
        readString();


    return {

        standardVersion,

        vendorExtensionId,

        vendorExtensionVersion,

        vendorExtensionDescription,

        functionalMode,

        operations,

        events,

        deviceProperties,

        captureFormats,

        imageFormats,

        manufacturer,

        model,

        deviceVersion,

        serialNumber
    };
}


/*
 * ----------------------------------------------------------
 * Display DeviceInfo
 * ----------------------------------------------------------
 */

function displayDeviceInfo(
    info
) {

    deviceInfo.innerHTML =
        "";


    const rows = [

        [
            "Manufacturer",
            info.manufacturer
        ],

        [
            "Model",
            info.model
        ],

        [
            "Device version",
            info.deviceVersion
        ],

        [
            "Serial number",
            info.serialNumber
                ? "[present]"
                : "[not provided]"
        ],

        [
            "MTP version",
            info.standardVersion
        ],

        [
            "Vendor extension",
            info.vendorExtensionDescription
        ],

        [
            "Vendor extension ID",
            hex(
                info.vendorExtensionId,
                8
            )
        ],

        [
            "Vendor extension version",
            info.vendorExtensionVersion
        ],

        [
            "Functional mode",
            info.functionalMode
        ],

        [
            "Supported operations",
            info.operations.length
        ],

        [
            "Supported events",
            info.events.length
        ],

        [
            "Device properties",
            info.deviceProperties.length
        ]

    ];


    for (
        const [
            label,
            value
        ] of rows
    ) {

        const labelElement =
            document.createElement(
                "div"
            );


        labelElement.className =
            "info-label";


        labelElement.textContent =
            label;


        const valueElement =
            document.createElement(
                "div"
            );


        valueElement.className =
            "info-value";


        valueElement.textContent =
            value;


        deviceInfo.appendChild(
            labelElement
        );


        deviceInfo.appendChild(
            valueElement
        );
    }


    deviceInfoCard.classList.remove(
        "hidden"
    );
}


/*
 * ----------------------------------------------------------
 * USB interface discovery
 * ----------------------------------------------------------
 */

function findMtpInterface(
    device
) {

    if (
        !device.configuration
    ) {

        return null;
    }


    /*
     * First look for the standard MTP/PTP interface.
     */

    for (
        const iface of
        device.configuration.interfaces
    ) {

        for (
            const alternate of
            iface.alternates
        ) {

            if (
                alternate.interfaceClass ===
                    0x06 &&

                alternate.interfaceSubclass ===
                    0x01 &&

                alternate.interfaceProtocol ===
                    0x01
            ) {

                return {

                    interfaceNumber:
                        iface.interfaceNumber,

                    alternateSetting:
                        alternate.alternateSetting,

                    alternate
                };
            }
        }
    }


    /*
     * Fallback to any bulk IN + OUT interface.
     */

    for (
        const iface of
        device.configuration.interfaces
    ) {

        for (
            const alternate of
            iface.alternates
        ) {

            const hasIn =
                alternate.endpoints.some(
                    endpoint =>
                        endpoint.direction ===
                            "in" &&
                        endpoint.type ===
                            "bulk"
                );


            const hasOut =
                alternate.endpoints.some(
                    endpoint =>
                        endpoint.direction ===
                            "out" &&
                        endpoint.type ===
                            "bulk"
                );


            if (
                hasIn &&
                hasOut
            ) {

                return {

                    interfaceNumber:
                        iface.interfaceNumber,

                    alternateSetting:
                        alternate.alternateSetting,

                    alternate
                };
            }
        }
    }


    return null;
}


function findBulkEndpoints(
    alternate
) {

    let input = null;

    let output = null;


    for (
        const endpoint of
        alternate.endpoints
    ) {

        if (
            endpoint.type !==
            "bulk"
        ) {

            continue;
        }


        if (
            endpoint.direction ===
                "in" &&
            input === null
        ) {

            input =
                endpoint;
        }


        if (
            endpoint.direction ===
                "out" &&
            output === null
        ) {

            output =
                endpoint;
        }
    }


    return {
        input,
        output
    };
}


function displayUsbInfo(
    device
) {

    manufacturer.textContent =
        device.manufacturerName ||
        "Unknown";


    product.textContent =
        device.productName ||
        "Unknown";


    vendorId.textContent =
        hex(
            device.vendorId
        );


    productId.textContent =
        hex(
            device.productId
        );


    usbVersion.textContent =
        device.usbVersionMajor +
        "." +
        device.usbVersionMinor +
        "." +
        device.usbVersionSubminor;
}


function displayInterfaces(
    device
) {

    interfacesContainer.innerHTML =
        "";


    if (
        !device.configuration
    ) {

        interfacesContainer.textContent =
            "No USB configuration.";

        return;
    }


    for (
        const iface of
        device.configuration.interfaces
    ) {

        const box =
            document.createElement(
                "div"
            );


        box.className =
            "interface";


        const title =
            document.createElement(
                "div"
            );


        title.className =
            "interface-title";


        title.textContent =
            "Interface " +
            iface.interfaceNumber;


        box.appendChild(
            title
        );


        for (
            const alternate of
            iface.alternates
        ) {

            const section =
                document.createElement(
                    "div"
                );


            section.className =
                "alternate";


            const heading =
                document.createElement(
                    "div"
                );


            heading.className =
                "alternate-title";


            heading.textContent =
                "Alternate " +
                alternate.alternateSetting +
                " | Class " +
                hex(
                    alternate.interfaceClass,
                    2
                ) +
                " | Subclass " +
                hex(
                    alternate.interfaceSubclass,
                    2
                ) +
                " | Protocol " +
                hex(
                    alternate.interfaceProtocol,
                    2
                );


            section.appendChild(
                heading
            );


            for (
                const endpoint of
                alternate.endpoints
            ) {

                const endpointBox =
                    document.createElement(
                        "div"
                    );


                endpointBox.className =
                    "endpoint";


                endpointBox.textContent =
                    "Endpoint " +
                    endpoint.endpointNumber +
                    " | " +
                    endpoint.direction.toUpperCase() +
                    " | " +
                    endpoint.type +
                    " | packet size " +
                    endpoint.packetSize;


                section.appendChild(
                    endpointBox
                );
            }


            box.appendChild(
                section
            );
        }


        interfacesContainer.appendChild(
            box
        );
    }
}


/*
 * ----------------------------------------------------------
 * Connect
 * ----------------------------------------------------------
 */

async function connectZune() {

    if (
        !navigator.usb
    ) {

        setStatus(
            "WebUSB is not available in this browser.",
            "error"
        );

        return;
    }


    try {

        /*
         * Chrome keeps WebUSB permission for this origin.
         *
         * If the Zune has already been approved, getDevices()
         * returns it directly. This is what Chrome labels
         * "Zune - Paired" in the picker. It does NOT mean the
         * USB connection is already open.
         *
         * Only show the picker when there is no previously
         * authorized Zune available.
         */
        setStatus(
            "Looking for an authorized Zune 30...",
            "working"
        );

        const authorizedDevices =
            await navigator.usb.getDevices();

        const matchingDevices =
            authorizedDevices.filter(
                device =>
                    device.vendorId === 0x045E &&
                    device.productId === 0x0710
            );

        if (matchingDevices.length > 0) {

            zuneDevice =
                matchingDevices[0];

            logStep(
                "Found previously authorized Zune 30. Skipping the USB chooser."
            );

        } else {

            setStatus(
                "Select your Zune 30...",
                "working"
            );

            /*
             * The actual Zune 30 PID is 0x0710.
             */
            zuneDevice =
                await navigator.usb.requestDevice({
                    filters: [
                        {
                            vendorId: 0x045E,
                            productId: 0x0710
                        }
                    ]
                });
        }


        setStatus(
            "Opening Zune USB connection...",
            "working"
        );


        /*
         * getDevices() returns an authorized USBDevice, but that does NOT
         * mean the WebUSB session is currently open. Always open it before
         * reading configuration or claiming an interface.
         */
        if (!zuneDevice.opened) {

            logStep(
                "Opening authorized Zune USB device..."
            );

            await zuneDevice.open();
        }


        /*
         * A failed MTPZ handshake can leave the Zune's MTP responder
         * wedged. A fresh WebUSB open is not enough to clear that state,
         * so reset the USB device before claiming the MTP interface.
         *
         * reset() is safe here because there is no pending transfer yet.
         * It can unconfigure the device, so configuration 1 is restored
         * immediately afterward.
         */
        if (typeof zuneDevice.reset === "function") {
            logStep(
                "Resetting USB device before opening the MTP session..."
            );

            await zuneDevice.reset();

            if (zuneDevice.configuration === null) {
                logStep(
                    "Selecting USB configuration 1 after USB reset..."
                );

                await zuneDevice.selectConfiguration(1);
            }
        }


        /*
         * reset() may leave the device unconfigured, so select
         * configuration 1 again when necessary.
         */
        if (
            zuneDevice.configuration ===
            null
        ) {

            logStep(
                "Selecting USB configuration 1..."
            );

            await zuneDevice.selectConfiguration(
                1
            );
        }


        displayUsbInfo(
            zuneDevice
        );


        displayInterfaces(
            zuneDevice
        );


        results.classList.remove(
            "hidden"
        );


        const found =
            findMtpInterface(
                zuneDevice
            );


        if (!found) {

            throw new Error(
                "No MTP interface was found."
            );
        }


        /*
         * Important:
         * Save this immediately so cleanup can release it.
         */

        mtpInterfaceNumber =
            found.interfaceNumber;


        const endpoints =
            findBulkEndpoints(
                found.alternate
            );


        if (
            !endpoints.input ||
            !endpoints.output
        ) {

            throw new Error(
                "MTP bulk endpoints were not found."
            );
        }


        mtpBulkInEndpoint =
            endpoints.input.endpointNumber;


        mtpBulkInPacketSize =
            endpoints.input.packetSize || 64;


        mtpBulkOutEndpoint =
            endpoints.output.endpointNumber;


        mtpInterface.textContent =
            "Interface " +
            mtpInterfaceNumber +
            " / alternate " +
            found.alternateSetting;


        bulkIn.textContent =
            "Endpoint " +
            mtpBulkInEndpoint;


        bulkOut.textContent =
            "Endpoint " +
            mtpBulkOutEndpoint;


        setStatus(
            "Claiming MTP interface...",
            "working"
        );


        await zuneDevice.claimInterface(
            mtpInterfaceNumber
        );


        if (
            found.alternateSetting !==
            0
        ) {

            await zuneDevice
                .selectAlternateInterface(
                    mtpInterfaceNumber,
                    found.alternateSetting
                );
        }


        setConnectionState(
            true
        );


        /*
         * Open MTP session.
         */

        setStatus(
            "Opening MTP session...",
            "working"
        );


        await openMtpSession();


        /*
         * Zune MTPZ requires GetDeviceInfo before
         * SessionInitiatorInfo (property 0xD406).
         *
         * Expected sequence:
         *
         *   OpenSession (transaction 0)
         *   GetDeviceInfo (transaction 1)
         *   SetDevicePropValue / D406 (transaction 2)
         *   MTPZ handshake
         *
         * Do not move GetDeviceInfo below authenticateMtpz().
         */

        setStatus(
            "Requesting Zune device information...",
            "working"
        );


        const info =
            await getDeviceInfo();


        /*
         * Authenticate MTPZ.
         */

        setStatus(
            "Authenticating with Zune MTPZ...",
            "working"
        );


        await authenticateMtpz();


        /*
         * MTPZ succeeded.
         */

        setStatus(
            "MTPZ authentication succeeded.",
            "working"
        );


        setStatus(
            "Zune 30 authenticated successfully.",
            "success"
        );

        showMusicManager();
        showPicturesManager();


        logStep(
            ""
        );


        logStep(
            "================================"
        );


        logStep(
            "ZUNE AUTHENTICATION SUCCESS"
        );


        logStep(
            "================================"
        );


        logStep(
            "Model: " +
            (
                info.model ||
                "Zune"
            )
        );


    } catch (error) {

        console.error(
            "Zune connection error:",
            error
        );


        logStep(
            ""
        );


        const errorMessage =
            error &&
            error.message
                ? error.message
                : String(error);


        logStep(
            "ERROR: " +
            errorMessage
        );


        if (
            errorMessage.toLowerCase().includes(
                "timed out"
            )
        ) {

            logStep(
                "The Zune did not answer the USB transfer in time. " +
                "The connection will be closed so it can be retried."
            );
        }


        setStatus(
            "Connection/authentication failed: " +
            (
                error &&
                error.message
                    ? error.message
                    : String(error)
            ),
            "error"
        );


        await cleanupConnection();
    }
}


/*
 * ----------------------------------------------------------
 * Cleanup
 * ----------------------------------------------------------
 */



/*
 * ----------------------------------------------------------
 * Picture management
 * ----------------------------------------------------------
 */

function pictureLog(text) {
    if (!pictureLogOutput) return;
    pictureLogOutput.textContent += (pictureLogOutput.textContent ? "\n" : "") + text;
}

function setPictureScanState(text) {
    if (pictureScanState) pictureScanState.textContent = text;
}

function formatPictureBytes(bytes) {
    const value = Number(bytes) || 0;
    if (value < 1024) return value + " B";
    if (value < 1024 * 1024) return (value / 1024).toFixed(value < 10240 ? 1 : 0) + " KB";
    return (value / (1024 * 1024)).toFixed(value < 10 * 1024 * 1024 ? 1 : 0) + " MB";
}

function updatePictureTransferButton() {
    if (!pausePictureTransferButton) return;
    pausePictureTransferButton.disabled = !pictureTransferActive;
    pausePictureTransferButton.textContent = pictureTransferPaused ? "Resume transfer" : "Pause transfer";
}

function requestPictureTransferPause() {
    if (!pictureTransferActive) return;
    pictureTransferPaused = !pictureTransferPaused;
    if (pictureTransferPaused) {
        pictureLog("Pause requested. The current picture will finish, then the transfer will pause safely.");
        setPictureScanState(pictureTransferCurrent ? "Finishing current picture, then pausing: " + pictureTransferCurrent : "Pausing transfer...");
    } else {
        pictureLog("Transfer resume requested.");
        setPictureScanState(pictureTransferCurrent ? "Resuming: " + pictureTransferCurrent : "Resuming transfer...");
    }
    updatePictureTransferButton();
}

async function waitForPictureTransferResume() {
    while (pictureTransferPaused || !sessionOpen) {
        if (!sessionOpen) {
            if (!pictureTransferWaitingForReconnect) {
                pictureTransferWaitingForReconnect = true;
                pictureLog("Zune disconnected. Transfer is paused safely. Reconnect the Zune and click Connect Zune to continue.");
            }
            setPictureScanState("Transfer paused — waiting for the Zune to reconnect...");
        } else {
            setPictureScanState("Transfer paused. Click Resume transfer to continue.");
        }
        await new Promise(resolve => setTimeout(resolve, 500));
    }
    if (pictureTransferWaitingForReconnect) {
        pictureTransferWaitingForReconnect = false;
        pictureLog("Zune reconnected. Continuing from the next safe picture boundary.");
    }
}

async function waitForPictureTransferReconnectOnly() {
    while (!sessionOpen) {
        setPictureScanState("Transfer paused — waiting for the Zune to reconnect...");
        await new Promise(resolve => setTimeout(resolve, 500));
    }
    pictureTransferWaitingForReconnect = false;
    pictureLog("Zune reconnected. Continuing the transfer.");
}

function pictureTransferStarted() {
    pictureTransferActive = true;
    pictureTransferPaused = false;
    pictureTransferWaitingForReconnect = false;
    pictureTransferCurrent = "";
    musicFastTransport = true;
    updatePictureTransferButton();
}

function pictureTransferFinished() {
    pictureTransferActive = false;
    pictureTransferPaused = false;
    pictureTransferWaitingForReconnect = false;
    pictureTransferCurrent = "";
    musicFastTransport = false;
    updatePictureTransferButton();
}

function renderZunePictures(items) {
    pictureGrid.innerHTML = "";
    pictureBadge.textContent = items.length + (items.length === 1 ? " picture" : " pictures");

    if (!items.length) {
        pictureGrid.innerHTML = '<div style="color:#777;font-size:13px;">No JPEG pictures were found on the Zune.</div>';
        if (clearZunePicturesButton) clearZunePicturesButton.disabled = true;
        return;
    }

    if (clearZunePicturesButton) clearZunePicturesButton.disabled = false;

    for (const picture of items) {
        const panel = document.createElement("div");
        panel.className = "picture-panel";

        const placeholder = document.createElement("div");
        placeholder.className = "picture-preview-placeholder";
        placeholder.textContent = "Preview not loaded";
        panel.appendChild(placeholder);

        const body = document.createElement("div");
        body.className = "picture-panel-body";

        const name = document.createElement("div");
        name.className = "picture-name";
        name.textContent = picture.info.filename || "picture.jpg";
        name.title = picture.info.filename || "picture.jpg";

        const details = document.createElement("div");
        details.className = "picture-details";
        const dimensions = picture.info.imagePixWidth && picture.info.imagePixHeight
            ? " · " + picture.info.imagePixWidth + " × " + picture.info.imagePixHeight
            : "";
        details.textContent = formatPictureBytes(picture.info.compressedSize) + dimensions;

        const actions = document.createElement("div");
        actions.className = "picture-actions";

        const previewButton = document.createElement("button");
        previewButton.type = "button";
        previewButton.className = "secondary";
        previewButton.textContent = "Preview";
        previewButton.addEventListener("click", async () => {
            previewButton.disabled = true;
            previewButton.textContent = "Loading...";
            try {
                const bytes = await mtpGetObject(picture.handle);
                const blob = new Blob([bytes], { type: "image/jpeg" });
                const url = URL.createObjectURL(blob);
                const img = document.createElement("img");
                img.className = "picture-preview";
                img.alt = picture.info.filename || "Zune picture";
                img.src = url;
                img.addEventListener("load", () => placeholder.replaceWith(img), { once: true });
                picture.previewUrl = url;
            } catch (error) {
                pictureLog("Preview failed for " + (picture.info.filename || "picture") + ": " + (error.message || error));
            } finally {
                previewButton.disabled = false;
                previewButton.textContent = "Preview";
            }
        });

        const downloadButton = document.createElement("button");
        downloadButton.type = "button";
        downloadButton.className = "secondary";
        downloadButton.textContent = "Download";
        downloadButton.addEventListener("click", async () => {
            downloadButton.disabled = true;
            try {
                const bytes = await mtpGetObject(picture.handle);
                const blob = new Blob([bytes], { type: "image/jpeg" });
                const url = URL.createObjectURL(blob);
                const link = document.createElement("a");
                link.href = url;
                link.download = safeFilename(picture.info.filename || "picture.jpg", "picture.jpg");
                document.body.appendChild(link);
                link.click();
                link.remove();
                setTimeout(() => URL.revokeObjectURL(url), 1000);
                pictureLog("Downloaded " + (picture.info.filename || "picture.jpg") + ".");
            } catch (error) {
                pictureLog("Download failed: " + (error.message || error));
            } finally {
                downloadButton.disabled = false;
            }
        });

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.className = "secondary";
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", async () => {
            const filename = picture.info.filename || "picture.jpg";
            if (!window.confirm('Delete "' + filename + '" from the Zune?\n\nThis cannot be undone.')) return;
            deleteButton.disabled = true;
            try {
                await mtpDeleteObject(picture.handle);
                pictureLog("Deleted " + filename + ".");
                await scanZunePictures();
            } catch (error) {
                pictureLog("Delete failed for " + filename + ": " + (error.message || error));
                deleteButton.disabled = false;
            }
        });

        actions.appendChild(previewButton);
        actions.appendChild(downloadButton);
        actions.appendChild(deleteButton);
        body.appendChild(name);
        body.appendChild(details);
        body.appendChild(actions);
        panel.appendChild(body);
        pictureGrid.appendChild(panel);
    }
}

async function discoverZunePictures() {
    if (!sessionOpen) throw new Error("The Zune MTP session is not open.");
    const storageIds = await getMusicStorageIds();
    if (!storageIds.length) throw new Error("The Zune reported no storage IDs.");
    const storageId = storageIds[0];

    setPictureScanState("Reading Zune picture objects...");
    pictureLog("Reading JPEG picture objects...");

    let handles;
    try {
        handles = await mtpGetObjectHandles(storageId, MTP_OBJECT_FORMAT_JPEG, 0xFFFFFFFF);
    } catch (_) {
        pictureLog("JPEG format filtering failed; scanning all objects instead.");
        handles = await mtpGetObjectHandles(storageId, 0, 0xFFFFFFFF);
    }

    const items = [];
    for (let i = 0; i < handles.length; i++) {
        if (!sessionOpen) throw new Error("The Zune disconnected during the picture scan.");
        const handle = handles[i];
        try {
            const info = await mtpGetObjectInfo(handle);
            const filename = String(info.filename || "");
            if (info.objectFormat !== MTP_OBJECT_FORMAT_JPEG && !/\.(jpe?g)$/i.test(filename)) continue;
            items.push({ handle, info });
            setPictureScanState("Reading pictures: " + (i + 1) + " / " + handles.length);
        } catch (error) {
            pictureLog("Could not inspect picture object 0x" + handle.toString(16).padStart(8, "0") + ": " + (error.message || error));
        }
    }

    items.sort((a, b) => String(a.info.filename || "").localeCompare(String(b.info.filename || ""), undefined, { sensitivity: "base" }));
    pictureItems = items;
    renderZunePictures(items);
    setPictureScanState("Read " + items.length + " JPEG picture(s) from the Zune.");
    pictureLog("Picture scan complete: " + items.length + " JPEG picture(s).");
    return items;
}

async function scanZunePictures() {
    await withPictureButtonLock(async () => {
        pictureLogOutput.textContent = "";
        try {
            await discoverZunePictures();
        } catch (error) {
            pictureLog("ERROR: " + (error.message || error));
            setPictureScanState("Picture scan failed.");
            throw error;
        }
    });
}

function getSelectedPictureFiles(input) {
    return Array.from(input && input.files || []).filter(file => /\.(jpe?g)$/i.test(file.name));
}

const PICTURE_MAX_WIDTH = 640;
const PICTURE_MAX_HEIGHT = 480;
const PICTURE_INITIAL_JPEG_QUALITY = 0.90;
const PICTURE_MIN_JPEG_QUALITY = 0.72;
const PICTURE_TARGET_MAX_BYTES = 750 * 1024;

function loadPictureForCompression(file) {
    return new Promise((resolve, reject) => {
        const url = URL.createObjectURL(file);
        const image = new Image();

        image.onload = () => {
            URL.revokeObjectURL(url);
            resolve(image);
        };

        image.onerror = () => {
            URL.revokeObjectURL(url);
            reject(new Error("The selected image could not be decoded by the browser."));
        };

        image.src = url;
    });
}

function canvasToJpegBlob(canvas, quality) {
    return new Promise((resolve, reject) => {
        canvas.toBlob(blob => {
            if (blob) {
                resolve(blob);
            } else {
                reject(new Error("The browser could not create the compressed JPEG."));
            }
        }, "image/jpeg", quality);
    });
}

async function preparePictureForZune(file) {
    const image = await loadPictureForCompression(file);
    const sourceWidth = image.naturalWidth || image.width;
    const sourceHeight = image.naturalHeight || image.height;

    if (!sourceWidth || !sourceHeight) {
        throw new Error("The selected image has invalid dimensions.");
    }

    const scale = Math.min(
        1,
        PICTURE_MAX_WIDTH / sourceWidth,
        PICTURE_MAX_HEIGHT / sourceHeight
    );

    const width = Math.max(1, Math.round(sourceWidth * scale));
    const height = Math.max(1, Math.round(sourceHeight * scale));

    const canvas = document.createElement("canvas");
    canvas.width = width;
    canvas.height = height;

    const context = canvas.getContext("2d", { alpha: false });
    if (!context) {
        throw new Error("The browser does not support image conversion.");
    }

    context.imageSmoothingEnabled = true;
    context.imageSmoothingQuality = "high";
    context.fillStyle = "#000000";
    context.fillRect(0, 0, width, height);
    context.drawImage(image, 0, 0, width, height);

    let quality = PICTURE_INITIAL_JPEG_QUALITY;
    let blob = await canvasToJpegBlob(canvas, quality);

    while (blob.size > PICTURE_TARGET_MAX_BYTES && quality > PICTURE_MIN_JPEG_QUALITY) {
        quality = Math.max(PICTURE_MIN_JPEG_QUALITY, quality - 0.05);
        blob = await canvasToJpegBlob(canvas, quality);
    }

    const compressedBytes = new Uint8Array(await blob.arrayBuffer());
    const outputName = safeFilename(file.name, "picture.jpg");

    return {
        file: new File([compressedBytes], outputName, { type: "image/jpeg", lastModified: Date.now() }),
        sourceWidth,
        sourceHeight,
        width,
        height,
        originalBytes: file.size,
        compressedBytes: compressedBytes.length,
        quality
    };
}

async function preparePictureBatch(files) {
    const prepared = [];

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        setPictureScanState("Preparing picture " + (i + 1) + " / " + files.length + ": " + file.name);

        const result = await preparePictureForZune(file);
        prepared.push(result);

        const resized = result.width !== result.sourceWidth || result.height !== result.sourceHeight;
        const sizeChanged = result.compressedBytes !== result.originalBytes;
        const description = resized
            ? result.sourceWidth + " × " + result.sourceHeight + " → " + result.width + " × " + result.height
            : result.width + " × " + result.height;

        pictureLog(
            "Prepared " + file.name + ": " +
            description +
            " · " + formatPictureBytes(result.originalBytes) +
            " → " + formatPictureBytes(result.compressedBytes) +
            (sizeChanged ? "" : " · size unchanged")
        );
    }

    return prepared;
}

async function uploadPictureFiles(files) {
    if (!sessionOpen) throw new Error("Connect and authenticate the Zune before uploading pictures.");
    const selected = getSelectedPictureFiles({ files });
    if (!selected.length) throw new Error("No JPEG/JPG pictures were selected.");

    setPictureScanState("Checking existing pictures...");
    const existing = await discoverZunePictures();
    const existingNames = new Set(existing.map(item => String(item.info.filename || "").toLowerCase()));
    const pendingSourceFiles = selected.filter(file => !existingNames.has(safeFilename(file.name, "picture.jpg").toLowerCase()));
    const skipped = selected.length - pendingSourceFiles.length;

    if (!pendingSourceFiles.length) {
        pictureLog("Nothing to upload. All selected picture filenames already exist on the Zune. Skipped " + skipped + ".");
        setPictureScanState("Nothing uploaded. " + skipped + " picture(s) already exist.");
        return;
    }

    pictureTransferStarted();
    try {
        const prepared = await preparePictureBatch(pendingSourceFiles);
        pictureLog("Prepared " + prepared.length + " picture(s) for the Zune at no more than 640 × 480 pixels." + (skipped ? " Skipping " + skipped + " existing filename(s)." : ""));

        let storageIds = await getMusicStorageIds();
        if (!storageIds.length) throw new Error("The Zune reported no storage IDs.");
        let storageId = storageIds[0];

        for (let i = 0; i < prepared.length; i++) {
            await waitForPictureTransferResume();
            const preparedPicture = prepared[i];
            const file = preparedPicture.file;
            const filename = safeFilename(file.name, "picture.jpg");
            pictureTransferCurrent = filename;
            pictureLog("Uploading picture " + (i + 1) + " / " + prepared.length + ": " + filename + " (" + preparedPicture.width + " × " + preparedPicture.height + ", " + formatPictureBytes(file.size) + ")");

            const bytes = new Uint8Array(await file.arrayBuffer());
            let completed = false;
            while (!completed) {
                let created = null;
                try {
                    await waitForPictureTransferResume();
                    created = await mtpSendObjectInfo(storageId, 0, MTP_OBJECT_FORMAT_JPEG, bytes.length, filename);
                    let lastProgressUpdate = -1;
                    await mtpSendObject(bytes, (sent, total) => {
                        const percent = Math.round((sent / Math.max(1, total)) * 100);
                        if (percent === 100 || percent >= lastProgressUpdate + 5) {
                            lastProgressUpdate = percent;
                            setPictureScanState("Uploading " + filename + " — " + (i + 1) + " / " + prepared.length + " (" + percent + "%)");
                        }
                    });
                    completed = true;
                    pictureLog("Uploaded " + filename + " (" + formatPictureBytes(bytes.length) + ").");
                } catch (error) {
                    const message = String(error && error.message ? error.message : error);
                    const connectionFailure = !sessionOpen || /USB|MTP|device|transfer|disconnected|closed|endpoint|network/i.test(message);
                    if (!connectionFailure) throw error;
                    pictureTransferWaitingForReconnect = true;
                    pictureLog("USB/MTP connection interrupted on " + filename + ". Waiting for reconnect...");
                    await waitForPictureTransferReconnectOnly();
                    const reconnectedStorageIds = await getMusicStorageIds();
                    if (!reconnectedStorageIds.length) throw new Error("The Zune reported no storage IDs after reconnect.");
                    storageId = reconnectedStorageIds[0];
                    if (created && created.objectHandle && sessionOpen) {
                        try { await mtpDeleteObject(created.objectHandle); } catch (_) {}
                    }
                    pictureLog("Retrying " + filename + " from the beginning.");
                }
            }
            await yieldToBrowser();
        }

        pictureLog("Picture upload complete: " + prepared.length + " picture(s) added." + (skipped ? " " + skipped + " existing picture(s) were skipped." : ""));
        await discoverZunePictures();
    } finally {
        pictureTransferFinished();
    }
}

async function clearAllZunePictures() {
    if (!sessionOpen) throw new Error("Connect and authenticate the Zune first.");
    const pictures = await discoverZunePictures();
    if (!pictures.length) return;
    if (!window.confirm("Clear all pictures from the Zune?\n\nThis permanently deletes all JPEG/JPG picture objects found by the picture manager.\n\nThis cannot be undone.")) return;

    const originalText = clearZunePicturesButton.textContent;
    clearZunePicturesButton.disabled = true;
    clearZunePicturesButton.textContent = "Clearing...";
    try {
        for (let i = 0; i < pictures.length; i++) {
            if (!sessionOpen) throw new Error("The Zune disconnected while clearing pictures.");
            await mtpDeleteObject(pictures[i].handle);
            pictureLog("Deleted " + (pictures[i].info.filename || "picture.jpg") + " — " + (i + 1) + " / " + pictures.length);
            setPictureScanState("Clearing pictures: " + (i + 1) + " / " + pictures.length);
            await yieldToBrowser();
        }
        await discoverZunePictures();
    } finally {
        clearZunePicturesButton.disabled = false;
        clearZunePicturesButton.textContent = originalText;
    }
}

async function withPictureButtonLock(callback) {
    const controls = [scanPicturesButton, uploadPicturesButton, uploadPictureFolderButton, clearZunePicturesButton, pictureFileInput, pictureFolderInput];
    controls.forEach(control => { if (control) control.disabled = true; });
    try {
        return await callback();
    } finally {
        controls.forEach(control => { if (control) control.disabled = false; });
        if (clearZunePicturesButton) clearZunePicturesButton.disabled = pictureItems.length === 0;
        updatePictureTransferButton();
    }
}

function showPicturesManager() {
    if (pictureCard) pictureCard.classList.remove("hidden");
    if (videoCard) videoCard.classList.remove("hidden");
}

/*
 * ----------------------------------------------------------
 * Video management
 * ----------------------------------------------------------
 */

const VIDEO_MAX_WIDTH = 320;
const VIDEO_MAX_HEIGHT = 240;
const VIDEO_FPS = 30;
const VIDEO_BITRATE = "256k";
const VIDEO_MAXRATE = "256k";
const VIDEO_AUDIO_BITRATE = "128k";
const VIDEO_AUDIO_RATE = "44100";

function videoLog(text) {
    if (!videoLogOutput) return;
    videoLogOutput.textContent += (videoLogOutput.textContent ? "\n" : "") + text;
    videoLogOutput.scrollTop = videoLogOutput.scrollHeight;
}

function setVideoScanState(text) {
    if (videoScanState) videoScanState.textContent = text;
}

function formatVideoBytes(bytes) {
    const value = Number(bytes) || 0;
    if (value < 1024) return value + " B";
    if (value < 1024 * 1024) return (value / 1024).toFixed(value < 10240 ? 1 : 0) + " KB";
    if (value < 1024 * 1024 * 1024) return (value / (1024 * 1024)).toFixed(value < 10 * 1024 * 1024 ? 1 : 0) + " MB";
    return (value / (1024 * 1024 * 1024)).toFixed(2) + " GB";
}

function getSelectedVideoFiles(input) {
    return Array.from(input && input.files || []).filter(file => {
        return /\.(wmv|asf|mp4|m4v|mov|avi|mkv|webm|mpeg|mpg)$/i.test(file.name) ||
            String(file.type || "").toLowerCase().startsWith("video/");
    });
}

function updateVideoTransferButton() {
    if (!pauseVideoTransferButton) return;
    pauseVideoTransferButton.disabled = !videoTransferActive;
    pauseVideoTransferButton.textContent = videoTransferPaused ? "Resume transfer" : "Pause transfer";
}

function requestVideoTransferPause() {
    if (!videoTransferActive) return;
    videoTransferPaused = !videoTransferPaused;
    if (videoTransferPaused) {
        videoLog("Pause requested. The current video will finish, then the transfer will pause safely.");
        setVideoScanState(videoTransferCurrent ? "Finishing current video, then pausing: " + videoTransferCurrent : "Pausing transfer...");
    } else {
        videoLog("Transfer resume requested.");
        setVideoScanState(videoTransferCurrent ? "Resuming: " + videoTransferCurrent : "Resuming transfer...");
    }
    updateVideoTransferButton();
}

async function waitForVideoTransferResume() {
    while (videoTransferPaused || !sessionOpen) {
        if (!sessionOpen) {
            if (!videoTransferWaitingForReconnect) {
                videoTransferWaitingForReconnect = true;
                videoLog("Zune disconnected. Video transfer is paused safely. Reconnect the Zune and click Connect Zune to continue.");
            }
            setVideoScanState("Transfer paused — waiting for the Zune to reconnect...");
        } else {
            setVideoScanState("Transfer paused. Click Resume transfer to continue.");
        }
        await new Promise(resolve => setTimeout(resolve, 500));
    }
}

async function waitForVideoTransferReconnectOnly() {
    videoTransferWaitingForReconnect = true;
    while (!sessionOpen) {
        setVideoScanState("Transfer paused — waiting for the Zune to reconnect...");
        await new Promise(resolve => setTimeout(resolve, 500));
    }
    videoTransferWaitingForReconnect = false;
}

function videoTransferStarted() {
    videoTransferActive = true;
    videoTransferPaused = false;
    videoTransferWaitingForReconnect = false;
    videoTransferCurrent = "";
    updateVideoTransferButton();
}

function videoTransferFinished() {
    videoTransferActive = false;
    videoTransferPaused = false;
    videoTransferWaitingForReconnect = false;
    videoTransferCurrent = "";
    updateVideoTransferButton();
}

async function loadVideoFfmpeg() {
    if (ffmpegInstance && ffmpegInstance.loaded) return ffmpegInstance;
    if (ffmpegLoadingPromise) return ffmpegLoadingPromise;

    ffmpegLoadingPromise = (async () => {
        videoLog("Loading the browser video converter. The first load is about 31 MB.");
        const [{ FFmpeg }, { toBlobURL }] = await Promise.all([
            import("https://cdn.jsdelivr.net/npm/@ffmpeg/ffmpeg@0.12.15/dist/esm/index.js"),
            import("https://cdn.jsdelivr.net/npm/@ffmpeg/util@0.12.2/dist/esm/index.js")
        ]);

        // @ffmpeg/ffmpeg normally creates its class worker from the CDN URL.
        // Chrome blocks that worker because this site is hosted on a different
        // origin. Build a same-origin blob worker instead and inline its two
        // small ESM dependencies so the blob worker has no cross-origin imports.
        const workerBaseURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/ffmpeg@0.12.15/dist/esm";
        const [workerSource, constSource, errorsSource] = await Promise.all([
            fetch(workerBaseURL + "/worker.js").then(response => {
                if (!response.ok) throw new Error("Could not download the FFmpeg worker (HTTP " + response.status + ").");
                return response.text();
            }),
            fetch(workerBaseURL + "/const.js").then(response => {
                if (!response.ok) throw new Error("Could not download the FFmpeg worker constants (HTTP " + response.status + ").");
                return response.text();
            }),
            fetch(workerBaseURL + "/errors.js").then(response => {
                if (!response.ok) throw new Error("Could not download the FFmpeg worker errors (HTTP " + response.status + ").");
                return response.text();
            })
        ]);

        const inlineWorkerSource =
            constSource.replace(/export\s+/g, "") + "\n" +
            errorsSource.replace(/export\s+/g, "") + "\n" +
            workerSource
                .replace(/import\s+\{[^}]*\}\s+from\s+[\"']\.\/const\.js[\"'];?\s*/g, "")
                .replace(/import\s+\{[^}]*\}\s+from\s+[\"']\.\/errors\.js[\"'];?\s*/g, "");

        const classWorkerURL = URL.createObjectURL(
            new Blob([inlineWorkerSource], { type: "text/javascript" })
        );

        const ffmpeg = new FFmpeg();
        ffmpeg.on("log", ({ message }) => {
            if (Array.isArray(videoProbeMessages)) videoProbeMessages.push(String(message || ""));
            if (/error|invalid|failed|unsupported|encoder/i.test(message)) videoLog("Converter: " + message);
        });
        ffmpeg.on("progress", ({ progress }) => {
            if (videoTransferCurrent && Number.isFinite(progress)) {
                const percent = Math.max(0, Math.min(100, Math.round(progress * 100)));
                setVideoScanState("Converting " + videoTransferCurrent + " — " + percent + "%");
            }
        });

        // Do not require either FFmpeg core file to be stored on the InfinityFree
        // server. The uploaded 109 KB file is the UMD build, but this worker is
        // a module worker and therefore needs the ESM core when it falls back to
        // dynamic import(). Using the CDN ESM core directly also avoids the
        // blob: core URL that caused "failed to import ffmpeg-core.js".
        //
        // Keep the class worker as our same-origin blob worker because Chrome
        // blocks the normal cross-origin FFmpeg class worker on this site.
        const coreURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/core@0.12.10/dist/esm/ffmpeg-core.js";
        const wasmURL = "https://cdn.jsdelivr.net/npm/@ffmpeg/core@0.12.10/dist/esm/ffmpeg-core.wasm";

        await ffmpeg.load({
            classWorkerURL,
            coreURL,
            wasmURL
        });

        ffmpegInstance = ffmpeg;
        videoLog("Browser video converter loaded.");
        return ffmpeg;
    })().catch(error => {
        ffmpegLoadingPromise = null;
        throw error;
    });

    return ffmpegLoadingPromise;
}

function videoOutputName(filename) {
    const base = String(filename || "video").replace(/\.[^.]*$/, "");
    return safeFilename(base + ".wmv", "video.wmv");
}

function parseProbeNumber(text, pattern) {
    const match = String(text || "").match(pattern);
    return match ? Number(match[1]) : NaN;
}

function parseProbeBitrate(text) {
    const match = String(text || "").match(/(?:^|[\s,])([0-9]+(?:\.[0-9]+)?)\s*(?:kb\/s|kbps)(?:\s|$)/i);
    if (!match) return NaN;
    return Number(match[1]) * 1000;
}

function parseProbeStream(messages, kind) {
    const lines = messages.filter(line => new RegExp("Stream #\\d+:\\d+: " + kind + "\\b", "i").test(line));
    if (!lines.length) return null;
    const line = lines[0];
    const result = { line };
    if (kind === "Video") {
        const codecMatch = line.match(/Video:\s*([^,\s(]+)/i);
        const sizeMatch = line.match(/(\d+)x(\d+)/);
        const fpsMatch = line.match(/([0-9]+(?:\.[0-9]+)?)\s*(?:fps|tbr)/i);
        result.codec = codecMatch ? codecMatch[1].toLowerCase() : "";
        result.width = sizeMatch ? Number(sizeMatch[1]) : NaN;
        result.height = sizeMatch ? Number(sizeMatch[2]) : NaN;
        result.fps = fpsMatch ? Number(fpsMatch[1]) : NaN;
        result.bitrate = parseProbeBitrate(line);
    } else {
        const codecMatch = line.match(/Audio:\s*([^,\s(]+)/i);
        const rateMatch = line.match(/(\d+)\s*Hz/i);
        const channelMatch = line.match(/(mono|stereo|[0-9]+\\.?[0-9]*\\s*channels?)/i);
        result.codec = codecMatch ? codecMatch[1].toLowerCase() : "";
        result.sampleRate = rateMatch ? Number(rateMatch[1]) : NaN;
        result.channels = channelMatch ? (/stereo/i.test(channelMatch[1]) ? 2 : /mono/i.test(channelMatch[1]) ? 1 : Number(channelMatch[1])) : NaN;
        result.bitrate = parseProbeBitrate(line);
    }
    return result;
}

function extractVideoContainer(messages) {
    for (const line of messages) {
        const match = String(line || "").match(/Input #\d+,\s*([^,]+),/i);
        if (match) return match[1].trim();
    }
    return "";
}

function formatVideoDiagnostic(probe) {
    const video = probe && probe.video ? probe.video : null;
    const audio = probe && probe.audio ? probe.audio : null;
    const container = probe && probe.container ? probe.container : "unknown";
    const lines = ["Converted video details:"];
    lines.push("Container: " + container);
    if (video) {
        lines.push("Video codec: " + (video.codec || "unknown"));
        lines.push("Video size: " + ((Number.isFinite(video.width) && Number.isFinite(video.height)) ? video.width + "x" + video.height : "unknown"));
        lines.push("Video FPS: " + (Number.isFinite(video.fps) ? video.fps : "unknown"));
        lines.push("Video bitrate: " + (Number.isFinite(video.bitrate) ? Math.round(video.bitrate / 1000) + " kbps" : "unknown"));
    } else {
        lines.push("Video stream: not detected");
    }
    if (audio) {
        lines.push("Audio codec: " + (audio.codec || "unknown"));
        lines.push("Audio sample rate: " + (Number.isFinite(audio.sampleRate) ? audio.sampleRate + " Hz" : "unknown"));
        lines.push("Audio channels: " + (Number.isFinite(audio.channels) ? audio.channels : "unknown"));
        lines.push("Audio bitrate: " + (Number.isFinite(audio.bitrate) ? Math.round(audio.bitrate / 1000) + " kbps" : "unknown"));
    } else {
        lines.push("Audio stream: not detected");
    }
    return lines.join("\n");
}

async function probeGeneratedVideo(ffmpeg, filename) {
    videoProbeMessages = [];
    try {
        try {
            await ffmpeg.exec([
                "-hide_banner",
                "-i", filename,
                "-map", "0:v:0",
                "-map", "0:a:0?",
                "-c", "copy",
                "-f", "null",
                "-"
            ]);
        } catch (_) {
            // FFmpeg may return non-zero for the null muxer while still logging
            // the complete stream information we need.
        }
        const messages = videoProbeMessages.slice();
        const video = parseProbeStream(messages, "Video");
        const audio = parseProbeStream(messages, "Audio");
        return {
            container: extractVideoContainer(messages),
            video,
            audio,
            messages
        };
    } finally {
        videoProbeMessages = null;
    }
}

async function logGeneratedVideoDiagnostics(ffmpeg, filename, sourceName) {
    const probe = await probeGeneratedVideo(ffmpeg, filename);
    videoLog("\n" + formatVideoDiagnostic(probe));
    if (!probe.video || !probe.audio) {
        videoLog("Warning: FFmpeg could not detect both required video and audio streams in the converted file.");
    }
    videoLog("Source: " + sourceName);
    return probe;
}

async function inspectVideoCompatibility(file) {
    if (!/\\.(wmv|asf)$/i.test(file.name)) return { compatible: false, reason: "not a WMV/ASF source" };

    const ffmpeg = await loadVideoFfmpeg();
    const inputName = "probe_video" + (String(file.name).match(/\.[^.]+$/) || [".bin"])[0].toLowerCase();
    const inputBytes = new Uint8Array(await file.arrayBuffer());
    if (!inputBytes.length) return { compatible: false, reason: "empty file" };

    videoProbeMessages = [];
    try {
        await ffmpeg.writeFile(inputName, inputBytes);
        try {
            await ffmpeg.exec([
                "-hide_banner",
                "-i", inputName,
                "-t", "0.01",
                "-map", "0:v:0",
                "-map", "0:a:0?",
                "-c", "copy",
                "-f", "null",
                "-"
            ]);
        } catch (_) {
            // FFmpeg can return non-zero for the null muxer while still emitting
            // the stream information needed for this compatibility check.
        }

        const messages = videoProbeMessages.slice();
        const video = parseProbeStream(messages, "Video");
        const audio = parseProbeStream(messages, "Audio");
        if (!video || !audio) return { compatible: false, reason: "missing video or audio stream" };

        const codec = video.codec;
        const isWmv8 = codec === "wmv2";
        const isWmv9 = codec === "wmv3" || codec === "vc1" || codec === "vc-1";
        const maxVideoBitrate = isWmv8 ? 736000 : isWmv9 ? 1500000 : 0;
        const compatible =
            (isWmv8 || isWmv9) &&
            Number.isFinite(video.width) && video.width <= VIDEO_MAX_WIDTH &&
            Number.isFinite(video.height) && video.height <= VIDEO_MAX_HEIGHT &&
            Number.isFinite(video.fps) && video.fps <= VIDEO_FPS + 0.01 &&
            Number.isFinite(video.bitrate) && video.bitrate <= maxVideoBitrate &&
            (audio.codec === "wmav1" || audio.codec === "wmav2") &&
            Number.isFinite(audio.sampleRate) && audio.sampleRate <= 44100 &&
            Number.isFinite(audio.channels) && audio.channels === 2 &&
            Number.isFinite(audio.bitrate) && audio.bitrate <= 192000;

        if (!compatible) {
            return {
                compatible: false,
                reason: "video stream is outside the Zune 30 limits",
                video,
                audio
            };
        }

        return { compatible: true, video, audio };
    } finally {
        videoProbeMessages = null;
        try { await ffmpeg.deleteFile(inputName); } catch (_) {}
    }
}

async function prepareVideoForZune(file) {
    const compatibility = await inspectVideoCompatibility(file);
    if (compatibility.compatible) {
        const outputName = safeFilename(String(file.name).replace(/\.[^.]*$/, ".wmv"), "video.wmv");
        videoLog("Already Zune-compatible: " + file.name + ". Skipping conversion.");
        return new File([file], outputName, {
            type: "video/x-ms-wmv",
            lastModified: file.lastModified || Date.now()
        });
    }

    videoLog("" + file.name + " needs conversion: " + (compatibility.reason || "unsupported format"));
    return await convertVideoForZune(file);
}

async function convertVideoForZune(file) {
    const ffmpeg = await loadVideoFfmpeg();
    const inputName = "input_video" + (String(file.name).match(/\.[^.]+$/) || [".bin"])[0].toLowerCase();
    const outputName = "output_video.wmv";

    setVideoScanState("Reading " + file.name + " for conversion...");
    const inputBytes = new Uint8Array(await file.arrayBuffer());
    if (!inputBytes.length) throw new Error("The selected video is empty.");

    try {
        await ffmpeg.writeFile(inputName, inputBytes);

        videoLog("Encoding with WMV2 video + WMA2 audio, 320x240, 30 fps, 256 kbps video, 128 kbps audio...");

        const exitCode = await ffmpeg.exec([
            "-i", inputName,
            "-map", "0:v:0",
            "-map", "0:a:0?",
            "-vf", "scale=320:240:force_original_aspect_ratio=decrease,pad=320:240:(ow-iw)/2:(oh-ih)/2,setsar=1",
            "-r", String(VIDEO_FPS),
            "-aspect", "4:3",
            "-c:v", "wmv2",
            "-b:v", VIDEO_BITRATE,
            "-pix_fmt", "yuv420p",
            "-c:a", "wmav2",
            "-b:a", VIDEO_AUDIO_BITRATE,
            "-ar", VIDEO_AUDIO_RATE,
            "-ac", "2",
            "-metadata", "title=" + String(file.name).replace(/\.[^.]*$/, ""),
            "-metadata", "comment=Converted for Zune 30",
            "-f", "asf",
            outputName
        ]);

        if (exitCode !== 0) throw new Error("The video converter could not create a Zune-compatible WMV file.");

        const outputData = await ffmpeg.readFile(outputName);
        const outputBytes = outputData instanceof Uint8Array ? outputData : new Uint8Array(outputData);
        if (!outputBytes.length) throw new Error("The video converter produced an empty file.");

        await logGeneratedVideoDiagnostics(ffmpeg, outputName, file.name);

        return new File([outputBytes], videoOutputName(file.name), {
            type: "video/x-ms-wmv",
            lastModified: Date.now()
        });
    } finally {
        try { await ffmpeg.deleteFile(inputName); } catch (_) {}
        try { await ffmpeg.deleteFile(outputName); } catch (_) {}
    }
}

async function discoverZuneVideos() {
    if (!sessionOpen) throw new Error("Connect and authenticate the Zune first.");
    setVideoScanState("Reading Zune videos...");

    let storageIds = await getMusicStorageIds();
    if (!storageIds.length) throw new Error("The Zune reported no storage IDs.");
    const storageId = storageIds[0];

    let handles = [];
    try {
        handles = await mtpGetObjectHandles(storageId, MTP_OBJECT_FORMAT_WMV, 0xFFFFFFFF);
    } catch (_) {}

    if (!handles.length) {
        try { handles = await mtpGetObjectHandles(storageId, 0xFFFFFFFF, 0xFFFFFFFF); } catch (_) {}
    }

    const items = [];
    for (let i = 0; i < handles.length; i++) {
        const handle = handles[i];
        try {
            const info = await mtpGetObjectInfo(handle);
            const filename = String(info.filename || "");
            if (info.objectFormat !== MTP_OBJECT_FORMAT_WMV && !/\.wmv$/i.test(filename)) continue;
            items.push({ handle, info });
        } catch (_) {}
    }

    videoItems = items;
    renderZuneVideos();
    if (videoBadge) videoBadge.textContent = items.length + (items.length === 1 ? " video" : " videos");
    if (clearZuneVideosButton) clearZuneVideosButton.disabled = items.length === 0;
    setVideoScanState("Found " + items.length + (items.length === 1 ? " video." : " videos."));
    return items;
}

function renderZuneVideos() {
    if (!videoList) return;
    videoList.innerHTML = "";
    if (!videoItems.length) return;

    videoItems.forEach(item => {
        const row = document.createElement("div");
        row.className = "video-item";

        const main = document.createElement("div");
        main.className = "video-item-main";
        const name = document.createElement("div");
        name.className = "video-item-name";
        name.textContent = item.info.filename || "video.wmv";
        const meta = document.createElement("div");
        meta.className = "video-item-meta";
        meta.textContent = formatVideoBytes(item.info.compressedSize || item.info.objectCompressedSize || item.info.size || 0);
        main.appendChild(name);
        main.appendChild(meta);

        const actions = document.createElement("div");
        actions.className = "video-item-actions";
        const downloadButton = document.createElement("button");
        downloadButton.type = "button";
        downloadButton.className = "secondary";
        downloadButton.textContent = "Download";
        downloadButton.addEventListener("click", async () => {
            if (!sessionOpen) return;
            const originalText = downloadButton.textContent;
            const filename = safeFilename(item.info.filename || "video.wmv", "video.wmv");
            let writable = null;
            let fileHandle = null;
            let completed = false;

            try {
                if (typeof window.showSaveFilePicker !== "function") {
                    throw new Error("This browser does not support streaming large-file downloads. Please use the latest Chrome or Chromium-based browser.");
                }

                downloadButton.disabled = true;
                downloadButton.textContent = "Choose location...";
                setVideoScanState("Choose where to save " + filename + ".");

                fileHandle = await window.showSaveFilePicker({
                    suggestedName: filename,
                    types: [{
                        description: "Zune WMV video",
                        accept: { "video/x-ms-wmv": [".wmv"] }
                    }]
                });

                writable = await fileHandle.createWritable();
                downloadButton.textContent = "Downloading...";
                setVideoScanState("Downloading " + filename + " directly from the Zune...");

                const totalBytes = Number(item.info.compressedSize || item.info.objectCompressedSize || item.info.size || 0);
                let receivedBytes = 0;

                await mtpGetObjectToWritable(item.handle, async (chunk, received, total) => {
                    await writable.write(chunk);
                    receivedBytes = received;

                    if (total > 0) {
                        const percent = Math.min(100, Math.round((received / total) * 100));
                        downloadButton.textContent = "Downloading " + percent + "%";
                        setVideoScanState(
                            "Downloading " + filename + " from the Zune... " +
                            formatVideoBytes(received) + " / " + formatVideoBytes(total)
                        );
                    } else {
                        setVideoScanState(
                            "Downloading " + filename + " from the Zune... " +
                            formatVideoBytes(received)
                        );
                    }
                }, totalBytes);

                await writable.close();
                writable = null;
                completed = true;
                downloadButton.textContent = "Downloaded";
                videoLog("Downloaded " + filename + " (" + formatVideoBytes(receivedBytes) + ") directly to the selected location.");
                setVideoScanState("Downloaded " + filename + ".");
            } catch (error) {
                if (writable) {
                    try { await writable.abort(); } catch (_) {}
                }

                if (error && error.name === "AbortError") {
                    setVideoScanState("Download cancelled.");
                } else {
                    alert(error && error.message ? error.message : String(error));
                    setVideoScanState("Download failed.");
                }
            } finally {
                if (!completed) {
                    downloadButton.disabled = false;
                    downloadButton.textContent = originalText;
                } else {
                    setTimeout(() => {
                        downloadButton.disabled = false;
                        downloadButton.textContent = originalText;
                    }, 1200);
                }
            }
        });
        actions.appendChild(downloadButton);

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.className = "secondary";
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", async () => {
            if (!sessionOpen) return;
            if (!window.confirm("Delete " + (item.info.filename || "this video") + " from the Zune?")) return;
            try {
                deleteButton.disabled = true;
                await mtpDeleteObject(item.handle);
                videoLog("Deleted " + (item.info.filename || "video.wmv") + ".");
                await discoverZuneVideos();
            } catch (error) {
                alert(error && error.message ? error.message : String(error));
                deleteButton.disabled = false;
            }
        });
        actions.appendChild(deleteButton);
        row.appendChild(main);
        row.appendChild(actions);
        videoList.appendChild(row);
    });
}

async function uploadVideoFiles(files) {
    if (!sessionOpen) throw new Error("Connect and authenticate the Zune before uploading videos.");
    const selected = getSelectedVideoFiles({ files });
    if (!selected.length) throw new Error("No supported video files were selected.");

    setVideoScanState("Checking existing videos...");
    const existing = await discoverZuneVideos();
    const existingNames = new Set(existing.map(item => String(item.info.filename || "").toLowerCase()));
    const pendingSourceFiles = selected.filter(file => !existingNames.has(videoOutputName(file.name).toLowerCase()));
    const skipped = selected.length - pendingSourceFiles.length;

    if (!pendingSourceFiles.length) {
        videoLog("Nothing to upload. All selected converted filenames already exist on the Zune. Skipped " + skipped + ".");
        return;
    }

    videoTransferStarted();
    musicFastTransport = true;
    try {
        let storageIds = await getMusicStorageIds();
        if (!storageIds.length) throw new Error("The Zune reported no storage IDs.");
        let storageId = storageIds[0];

        for (let i = 0; i < pendingSourceFiles.length; i++) {
            await waitForVideoTransferResume();
            const source = pendingSourceFiles[i];
            videoTransferCurrent = source.name;
            videoLog("Preparing video " + (i + 1) + " / " + pendingSourceFiles.length + ": " + source.name + " (" + formatVideoBytes(source.size) + ")");

            let converted;
            try {
                converted = await prepareVideoForZune(source);
            } catch (error) {
                throw new Error("Could not convert " + source.name + ": " + (error && error.message ? error.message : String(error)));
            }

            await waitForVideoTransferResume();
            videoLog("Converted " + source.name + " → " + converted.name + " (320 × 240 maximum, " + formatVideoBytes(converted.size) + ").");
            const bytes = new Uint8Array(await converted.arrayBuffer());
            let completed = false;

            while (!completed) {
                let created = null;
                try {
                    await waitForVideoTransferResume();
                    created = await mtpSendObjectInfo(storageId, 0, MTP_OBJECT_FORMAT_WMV, bytes.length, converted.name);
                    let lastProgressUpdate = -1;
                    await mtpSendObject(bytes, (sent, total) => {
                        const percent = Math.round((sent / Math.max(1, total)) * 100);
                        if (percent === 100 || percent >= lastProgressUpdate + 5) {
                            lastProgressUpdate = percent;
                            setVideoScanState("Uploading " + converted.name + " — " + (i + 1) + " / " + pendingSourceFiles.length + " (" + percent + "%)");
                        }
                    });
                    // The Zune uses the MTP Name property for the human-readable
                    // movie title. Keep it synchronized with the uploaded filename.
                    // The filename itself is already supplied in SendObjectInfo.
                    if (created && created.objectHandle) {
                        const title = String(converted.name);
                        try { await mtpSetObjectPropString(created.objectHandle, MTP_OBJECT_PROP_FILENAME, title); } catch (_) {}
                        try { await mtpSetObjectPropString(created.objectHandle, MTP_OBJECT_PROP_NAME, title); } catch (_) {}
                    }
                    completed = true;
                    videoLog("Uploaded " + converted.name + " (" + formatVideoBytes(bytes.length) + ").");
                } catch (error) {
                    const message = String(error && error.message ? error.message : error);
                    const connectionFailure = !sessionOpen || /USB|MTP|device|transfer|disconnected|closed|endpoint|network/i.test(message);
                    if (!connectionFailure) throw error;
                    videoLog("USB/MTP connection interrupted on " + converted.name + ". Waiting for reconnect...");
                    await waitForVideoTransferReconnectOnly();
                    const reconnectedStorageIds = await getMusicStorageIds();
                    if (!reconnectedStorageIds.length) throw new Error("The Zune reported no storage IDs after reconnect.");
                    storageId = reconnectedStorageIds[0];
                    if (created && created.objectHandle && sessionOpen) {
                        try { await mtpDeleteObject(created.objectHandle); } catch (_) {}
                    }
                    videoLog("Retrying " + converted.name + " from the beginning.");
                }
            }
            await yieldToBrowser();
        }

        videoLog("Video upload complete: " + pendingSourceFiles.length + " video(s) added." + (skipped ? " " + skipped + " existing video(s) were skipped." : ""));
        await discoverZuneVideos();
    } finally {
        musicFastTransport = false;
        videoTransferFinished();
    }
}

async function clearAllZuneVideos() {
    if (!sessionOpen) throw new Error("Connect and authenticate the Zune first.");
    const videos = await discoverZuneVideos();
    if (!videos.length) return;
    if (!window.confirm("Clear all videos from the Zune?\n\nThis permanently deletes all WMV video objects found by the video manager.\n\nThis cannot be undone.")) return;

    const originalText = clearZuneVideosButton.textContent;
    clearZuneVideosButton.disabled = true;
    clearZuneVideosButton.textContent = "Clearing...";
    try {
        for (let i = 0; i < videos.length; i++) {
            if (!sessionOpen) throw new Error("The Zune disconnected while clearing videos.");
            await mtpDeleteObject(videos[i].handle);
            videoLog("Deleted " + (videos[i].info.filename || "video.wmv") + " — " + (i + 1) + " / " + videos.length);
            setVideoScanState("Clearing videos: " + (i + 1) + " / " + videos.length);
            await yieldToBrowser();
        }
        await discoverZuneVideos();
    } finally {
        clearZuneVideosButton.disabled = false;
        clearZuneVideosButton.textContent = originalText;
    }
}

async function withVideoButtonLock(callback) {
    const controls = [scanVideosButton, uploadVideosButton, uploadVideoFolderButton, clearZuneVideosButton, videoFileInput, videoFolderInput];
    controls.forEach(control => { if (control) control.disabled = true; });
    try {
        return await callback();
    } finally {
        controls.forEach(control => { if (control) control.disabled = false; });
        if (clearZuneVideosButton) clearZuneVideosButton.disabled = videoItems.length === 0;
        updateVideoTransferButton();
    }
}


/*
 * ----------------------------------------------------------
 * Normal music MTP helpers
 * ----------------------------------------------------------
 */

function musicLog(text) {
    if (!musicLogOutput) return;
    musicLogOutput.textContent +=
        (musicLogOutput.textContent ? "\n" : "") +
        text;
}

function setMusicScanState(text) {
    if (musicScanState) {
        musicScanState.textContent = text;
    }
}

function bytesToUtf8(bytes) {
    try {
        return new TextDecoder("utf-8", { fatal: false }).decode(bytes);
    } catch (_) {
        return "";
    }
}

function decodeTextFrame(bytes, encoding) {
    if (!bytes || !bytes.length) return "";

    let text = "";

    try {
        if (encoding === 1) {
            if (bytes.length >= 2 && bytes[0] === 0xFF && bytes[1] === 0xFE) {
                text = new TextDecoder("utf-16le").decode(bytes.subarray(2));
            } else if (bytes.length >= 2 && bytes[0] === 0xFE && bytes[1] === 0xFF) {
                // Convert UTF-16BE to LE for TextDecoder.
                const converted = new Uint8Array(bytes.length - 2);
                for (let i = 2, j = 0; i + 1 < bytes.length; i += 2, j += 2) {
                    converted[j] = bytes[i + 1];
                    converted[j + 1] = bytes[i];
                }
                text = new TextDecoder("utf-16le").decode(converted);
            } else {
                text = new TextDecoder("utf-16le").decode(bytes);
            }
        } else if (encoding === 2) {
            text = new TextDecoder("utf-8").decode(bytes);
        } else if (encoding === 3) {
            text = new TextDecoder("utf-8").decode(bytes);
        } else {
            let out = "";
            for (const byte of bytes) {
                out += String.fromCharCode(byte);
            }
            text = out;
        }
    } catch (_) {
        text = bytesToUtf8(bytes);
    }

    return text
        .replace(/\0/g, "")
        .replace(/[\r\n]+/g, " ")
        .trim();
}

function cleanId3Text(value) {
    if (!value) return "";
    return value
        .replace(/\0/g, "")
        .replace(/\s+/g, " ")
        .trim();
}

function synchsafeToUint32(bytes) {
    return (
        ((bytes[0] & 0x7F) << 21) |
        ((bytes[1] & 0x7F) << 14) |
        ((bytes[2] & 0x7F) << 7) |
        (bytes[3] & 0x7F)
    ) >>> 0;
}

function id3SyncsafeSize(bytes, offset) {
    if (offset + 4 > bytes.length) return 0;
    return synchsafeToUint32(bytes.subarray(offset, offset + 4));
}

function parseId3v1(bytes) {
    if (bytes.length < 128) return {};
    const start = bytes.length - 128;
    const tag = String.fromCharCode(
        bytes[start], bytes[start + 1], bytes[start + 2]
    );
    if (tag !== "TAG") return {};

    const readField = (offset, length) => {
        return cleanId3Text(bytesToLatin1(bytes.subarray(start + offset, start + offset + length)));
    };

    const title = readField(3, 30);
    const artist = readField(33, 30);
    const album = readField(63, 30);
    const year = readField(93, 4);
    const genreByte = bytes[start + 127];

    return {
        title,
        artist,
        album,
        year,
        genre: genreByte !== 255 ? id3GenreName(genreByte) : ""
    };
}

function bytesToLatin1(bytes) {
    let out = "";
    for (const byte of bytes) {
        out += String.fromCharCode(byte);
    }
    return out;
}

const ID3_GENRES = [
    "Blues", "Classic Rock", "Country", "Dance", "Disco", "Funk", "Grunge", "Hip-Hop",
    "Jazz", "Metal", "New Age", "Oldies", "Other", "Pop", "R&B", "Rap", "Reggae", "Rock",
    "Techno", "Industrial", "Alternative", "Ska", "Death Metal", "Pranks", "Soundtrack",
    "Euro-Techno", "Ambient", "Trip-Hop", "Vocal", "Jazz+Funk", "Fusion", "Trance", "Classical",
    "Instrumental", "Acid", "House", "Game", "Sound Clip", "Gospel", "Noise", "AlternRock",
    "Bass", "Soul", "Punk", "Space", "Meditative", "Instrumental Pop", "Instrumental Rock", "Ethnic",
    "Gothic", "Darkwave", "Techno-Industrial", "Electronic", "Pop-Folk", "Eurodance", "Dream",
    "Southern Rock", "Comedy", "Cult", "Gangsta", "Top 40", "Christian Rap", "Pop/Funk", "Jungle",
    "Native American", "Cabaret", "New Wave", "Psychadelic", "Rave", "Showtunes", "Trailer", "Lo-Fi",
    "Tribal", "Acid Punk", "Acid Jazz", "Polka", "Retro", "Musical", "Rock & Roll", "Hard Rock"
];

function id3GenreName(index) {
    return ID3_GENRES[index] || "";
}

function parseMp3Metadata(bytes, filename = "") {
    const result = {
        title: "",
        artist: "",
        album: "",
        albumArtist: "",
        track: 0,
        genre: "",
        year: "",
        artwork: null
    };

    if (bytes.length >= 10 &&
        bytes[0] === 0x49 && bytes[1] === 0x44 && bytes[2] === 0x33) {
        const versionMajor = bytes[3];
        const flags = bytes[5];
        const tagSize = versionMajor >= 4
            ? synchsafeToUint32(bytes.subarray(6, 10))
            : (
                (bytes[6] << 21) |
                (bytes[7] << 14) |
                (bytes[8] << 7) |
                bytes[9]
            );

        const tagEnd = Math.min(bytes.length, 10 + tagSize);
        let offset = 10;

        if (flags & 0x40) {
            if (versionMajor === 3 && offset + 4 <= tagEnd) {
                const extSize = new DataView(bytes.buffer, bytes.byteOffset + offset, 4).getUint32(0, false);
                offset += 4 + extSize;
            } else if (versionMajor >= 4 && offset + 4 <= tagEnd) {
                const extSize = synchsafeToUint32(bytes.subarray(offset, offset + 4));
                offset += extSize;
            }
        }

        while (offset + 10 <= tagEnd) {
            const idBytes = bytes.subarray(offset, offset + 4);
            const id = String.fromCharCode(...idBytes);
            if (!/^[A-Z0-9]{4}$/.test(id)) break;

            let frameSize;
            if (versionMajor >= 4) {
                frameSize = id3SyncsafeSize(bytes, offset + 4);
            } else {
                frameSize = new DataView(bytes.buffer, bytes.byteOffset + offset + 4, 4).getUint32(0, false);
            }

            if (!frameSize || offset + 10 + frameSize > tagEnd) break;

            const frameFlags = new DataView(bytes.buffer, bytes.byteOffset + offset + 8, 2).getUint16(0, false);
            let frameData = bytes.subarray(offset + 10, offset + 10 + frameSize);

            if (versionMajor >= 4 && (frameFlags & 0x0002)) {
                frameData = unsynchronize(frameData);
            }

            const textFrameMap = {
                TIT2: "title",
                TPE1: "artist",
                TPE2: "albumArtist",
                TALB: "album",
                TCON: "genre",
                TRCK: "track",
                TYER: "year",
                TDRC: "year"
            };

            // Embedded ID3v2 album artwork. We intentionally use the
            // artwork embedded in the track itself; folder images are not
            // searched or used.
            if (id === "APIC" && frameData.length >= 4) {
                try {
                    const encoding = frameData[0];
                    let pos = 1;
                    const mimeEnd = frameData.indexOf(0, pos);
                    if (mimeEnd >= 0) {
                        const mime = new TextDecoder("latin1").decode(frameData.subarray(pos, mimeEnd)).toLowerCase();
                        pos = mimeEnd + 1;
                        if (pos < frameData.length) {
                            const pictureType = frameData[pos++];
                            const descEnd = findId3Terminator(frameData, pos, encoding);
                            if (descEnd >= 0) {
                                pos = descEnd + (encoding === 1 || encoding === 2 ? 2 : 1);
                                if (pos < frameData.length && /^(image\/(jpeg|jpg)|image\/png|image\/gif|image\/webp)/i.test(mime)) {
                                    const imageBytes = frameData.slice(pos);
                                    if (imageBytes.length) {
                                        const artwork = {
                                            mime: mime.indexOf("image/jpg") === 0 ? "image/jpeg" : mime,
                                            bytes: imageBytes,
                                            pictureType
                                        };
                                        // Prefer the ID3 front-cover picture (03),
                                        // but keep the first usable picture as fallback.
                                        if (!result.artwork || pictureType === 0x03) result.artwork = artwork;
                                    }
                                }
                            }
                        }
                    }
                } catch (_) {}
            }

            const key = textFrameMap[id];
            if (key && frameData.length >= 1) {
                const encoding = frameData[0];
                const text = cleanId3Text(decodeTextFrame(frameData.subarray(1), encoding));
                if (key === "track") {
                    const match = text.match(/\d+/);
                    result.track = match ? parseInt(match[0], 10) : 0;
                } else if (key === "genre") {
                    const genreMatch = text.match(/^\((\d+)\)$/);
                    result.genre = genreMatch ? (id3GenreName(parseInt(genreMatch[1], 10)) || text) : text;
                } else if (text) {
                    result[key] = text;
                }
            }

            offset += 10 + frameSize;
        }
    }

    const v1 = parseId3v1(bytes);
    if (!result.title) result.title = v1.title || "";
    if (!result.artist) result.artist = v1.artist || "";
    if (!result.album) result.album = v1.album || "";
    if (!result.genre) result.genre = v1.genre || "";
    if (!result.year) result.year = v1.year || "";

    if (!result.title) {
        const base = filename.replace(/^.*[\\/]/, "").replace(/\.mp3$/i, "");
        result.title = base || "Untitled";
    }

    return result;
}

function unsynchronize(bytes) {
    const out = [];
    for (let i = 0; i < bytes.length; i++) {
        if (bytes[i] === 0xFF && bytes[i + 1] === 0x00) {
            out.push(0xFF);
            i++;
        } else {
            out.push(bytes[i]);
        }
    }
    return new Uint8Array(out);
}

let folderAlbumChoices = new Map();

function updateFolderAlbumSelectionSummary() {
    const choices = Array.from(folderAlbumChoices.values());
    const selected = choices.filter(choice => choice.selected);
    const selectedTracks = selected.reduce((total, choice) => total + choice.files.length, 0);
    const totalTracks = choices.reduce((total, choice) => total + choice.files.length, 0);

    if (!choices.length) {
        folderAlbumSelectionSummary.textContent = "No folder selected.";
        uploadFolderButton.disabled = true;
        return;
    }

    folderAlbumSelectionSummary.textContent =
        selected.length + " of " + choices.length + " album(s) selected — " +
        selectedTracks + " of " + totalTracks + " track(s) selected.";

    uploadFolderButton.disabled = selected.length === 0;
    uploadFolderButton.textContent = selected.length === choices.length
        ? "Upload all albums"
        : "Upload selected albums";
}

function renderFolderAlbumSelection() {
    folderAlbumList.textContent = "";

    const choices = Array.from(folderAlbumChoices.values()).sort((a, b) => {
        const artistCompare = a.artist.localeCompare(b.artist, undefined, { sensitivity: "base" });
        if (artistCompare !== 0) return artistCompare;
        return a.album.localeCompare(b.album, undefined, { sensitivity: "base" });
    });

    for (const choice of choices) {
        const label = document.createElement("label");
        label.className = "folder-album-option";

        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.checked = choice.selected;
        checkbox.dataset.albumKey = choice.key;

        checkbox.addEventListener("change", () => {
            choice.selected = checkbox.checked;
            updateFolderAlbumSelectionSummary();
        });

        const info = document.createElement("div");
        info.className = "folder-album-option-info";

        const title = document.createElement("div");
        title.className = "folder-album-option-title";
        title.textContent = choice.album;

        const details = document.createElement("div");
        details.className = "folder-album-option-details";
        details.textContent = choice.artist + " • " + choice.files.length +
            (choice.files.length === 1 ? " track" : " tracks");

        info.appendChild(title);
        info.appendChild(details);
        label.appendChild(checkbox);
        label.appendChild(info);
        folderAlbumList.appendChild(label);
    }

    folderAlbumSelection.classList.toggle("hidden", choices.length === 0);
    updateFolderAlbumSelectionSummary();
}

function setAllFolderAlbumsSelected(selected) {
    for (const choice of folderAlbumChoices.values()) {
        choice.selected = selected;
    }
    renderFolderAlbumSelection();
}

async function prepareFolderAlbumSelection() {
    folderAlbumChoices = new Map();
    folderAlbumSelection.classList.add("hidden");
    folderAlbumList.textContent = "";
    folderAlbumSelectionSummary.textContent = "Reading album information...";
    uploadFolderButton.disabled = true;
    uploadFolderButton.textContent = "Upload selected albums";

    const files = Array.from(musicFolderInput.files || []).filter(file => /\.mp3$/i.test(file.name));
    if (!files.length) {
        folderAlbumSelectionSummary.textContent = "No MP3 files were found in the selected folder.";
        return;
    }

    const parsedFiles = await readUploadedFileMetadataBatch(files, (completed, total) => {
        folderAlbumSelectionSummary.textContent =
            "Reading album information: " + completed + " / " + total + " tracks...";
    });

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const parsed = parsedFiles[i];
        const album = detectAlbumForFile(parsed.metadata, file);
        const artist = detectAlbumArtist(parsed.metadata);
        const key = musicAlbumKey(artist, album);

        if (!folderAlbumChoices.has(key)) {
            folderAlbumChoices.set(key, {
                key,
                album,
                artist,
                files: [],
                selected: true
            });
        }

        folderAlbumChoices.get(key).files.push(file);
    }

    renderFolderAlbumSelection();
}

function getSelectedFolderFiles() {
    const selectedFiles = [];
    for (const choice of folderAlbumChoices.values()) {
        if (!choice.selected) continue;
        selectedFiles.push(...choice.files);
    }
    return selectedFiles;
}

function getFileRelativeFolder(file) {
    const relative = file.webkitRelativePath || file.name || "";
    const parts = relative.split(/[\\/]+/).filter(Boolean);
    if (parts.length <= 1) return "";
    parts.pop();
    if (parts[0] && parts.length === 1) return parts[0];
    return parts[parts.length - 1] || "";
}

function findId3Terminator(bytes, start, encoding) {
    if (encoding === 1 || encoding === 2) {
        for (let i = start; i + 1 < bytes.length; i += 2) {
            if (bytes[i] === 0 && bytes[i + 1] === 0) return i;
        }
    } else {
        for (let i = start; i < bytes.length; i++) {
            if (bytes[i] === 0) return i;
        }
    }
    return -1;
}

function detectAlbumForFile(metadata, file) {
    const metadataAlbum = cleanId3Text(metadata.album);
    if (metadataAlbum) return metadataAlbum;

    const folder = cleanId3Text(getFileRelativeFolder(file));
    if (folder) return folder;

    return "Unknown Album";
}

function detectAlbumArtist(metadata) {
    return cleanId3Text(metadata.albumArtist) || cleanId3Text(metadata.artist) || "Unknown Artist";
}

function safeFilename(filename, fallback = "audio.mp3") {
    const normalized = String(filename || "")
        .replace(/[\\/:*?"<>|]/g, "_")
        .replace(/\s+/g, " ")
        .trim();
    return normalized || fallback;
}

function bytesEqual(a, b) {
    if (!a || !b || a.length !== b.length) return false;
    for (let i = 0; i < a.length; i++) if (a[i] !== b[i]) return false;
    return true;
}

async function mtpGetObjectHandles(storageId, format = 0, parent = 0xFFFFFFFF) {
    transactionId++;
    const tx = transactionId;

    await bulkWrite(buildMtpCommand(
        MTP_GET_OBJECT_HANDLES,
        tx,
        [storageId, format, parent]
    ));

    const firstBytes = await receiveContainer();
    const first = parseContainer(firstBytes);

    if (first.transactionId !== tx) {
        throw new Error(
            "GetObjectHandles transaction mismatch: expected " +
            tx + ", received " + first.transactionId + "."
        );
    }

    if (first.type === MTP_RESPONSE) {
        if (first.code !== MTP_OK) {
            throw new Error(
                "MTP response " +
                hex(first.code) +
                " for GetObjectHandles (format=" +
                hex(format) +
                ", parent=" +
                hex(parent) +
                ")."
            );
        }

        return [];
    }

    if (first.type !== MTP_DATA) {
        throw new Error("GetObjectHandles returned unexpected container type " + hex(first.type) + ".");
    }

    if (first.payload.length < 4) {
        await receiveResponse();
        return [];
    }

    const view = new DataView(
        first.payload.buffer,
        first.payload.byteOffset,
        first.payload.byteLength
    );
    const count = view.getUint32(0, true);
    const handles = [];

    for (let i = 0; i < count && 4 + i * 4 + 4 <= first.payload.length; i++) {
        handles.push(view.getUint32(4 + i * 4, true) >>> 0);
    }

    const response = await receiveResponse();
    if (response.transactionId !== tx) {
        throw new Error("GetObjectHandles response transaction mismatch.");
    }

    return handles;
}

async function mtpGetObjectInfo(objectHandle) {
    transactionId++;
    const tx = transactionId;

    await bulkWrite(buildMtpCommand(MTP_GET_OBJECT_INFO, tx, [objectHandle]));
    const dataBytes = await receiveContainer();
    const data = parseContainer(dataBytes);
    if (data.type !== MTP_DATA) throw new Error("GetObjectInfo did not return DATA.");
    if (data.transactionId !== tx) throw new Error("GetObjectInfo transaction mismatch.");

    const info = parseObjectInfoDataset(data.payload);
    await receiveResponse();
    return info;
}

function parseObjectInfoDataset(bytes) {
    const view = new DataView(bytes.buffer, bytes.byteOffset, bytes.byteLength);
    let offset = 0;

    const ensure = n => {
        if (offset + n > bytes.length) throw new Error("ObjectInfo dataset is truncated.");
    };
    const u16 = () => { ensure(2); const v = view.getUint16(offset, true); offset += 2; return v; };
    const u32 = () => { ensure(4); const v = view.getUint32(offset, true); offset += 4; return v; };
    const str = () => {
        if (offset >= bytes.length) return "";
        const result = decodeMtpString(view, offset);
        offset = result.offset;
        return result.value;
    };

    const storageId = u32();
    const objectFormat = u16();
    const protectionStatus = u16();
    const compressedSize = u32();
    const thumbFormat = u16();
    const thumbCompressedSize = u32();
    const thumbPixWidth = u32();
    const thumbPixHeight = u32();
    const imagePixWidth = u32();
    const imagePixHeight = u32();
    const imageBitDepth = u32();
    const parentObject = u32();
    const associationType = u16();
    const associationDesc = u32();
    const sequenceNumber = u32();
    const filename = str();
    const dateCreated = str();
    const dateModified = str();
    const keywords = str();

    return {
        storageId,
        objectFormat,
        protectionStatus,
        compressedSize,
        thumbFormat,
        thumbCompressedSize,
        thumbPixWidth,
        thumbPixHeight,
        imagePixWidth,
        imagePixHeight,
        imageBitDepth,
        parentObject,
        associationType,
        associationDesc,
        sequenceNumber,
        filename,
        dateCreated,
        dateModified,
        keywords
    };
}

async function mtpGetObjectPropValue(objectHandle, propertyCode) {
    transactionId++;
    const tx = transactionId;

    await bulkWrite(buildMtpCommand(
        MTP_GET_OBJECT_PROP_VALUE,
        tx,
        [objectHandle, propertyCode]
    ));

    const dataBytes = await receiveContainer();
    const data = parseContainer(dataBytes);
    if (data.type !== MTP_DATA) throw new Error("GetObjectPropValue did not return DATA.");
    if (data.transactionId !== tx) throw new Error("GetObjectPropValue transaction mismatch.");
    await receiveResponse();
    return data.payload.slice();
}

async function mtpGetObjectPropString(objectHandle, propertyCode) {
    const payload = await mtpGetObjectPropValue(objectHandle, propertyCode);
    if (!payload.length) return "";
    const view = new DataView(payload.buffer, payload.byteOffset, payload.byteLength);
    return decodeMtpString(view, 0).value;
}

async function mtpGetObjectPropUint16(objectHandle, propertyCode) {
    const payload = await mtpGetObjectPropValue(objectHandle, propertyCode);
    if (payload.length < 2) throw new Error("MTP UINT16 property was too short.");
    return new DataView(payload.buffer, payload.byteOffset, payload.byteLength).getUint16(0, true);
}

async function mtpGetObjectPropUint32(objectHandle, propertyCode) {
    const payload = await mtpGetObjectPropValue(objectHandle, propertyCode);
    if (payload.length < 4) throw new Error("MTP UINT32 property was too short.");
    return new DataView(payload.buffer, payload.byteOffset, payload.byteLength).getUint32(0, true);
}

async function mtpGetObjectPropArray(objectHandle, propertyCode) {
    const payload = await mtpGetObjectPropValue(objectHandle, propertyCode);
    if (payload.length < 4) return new Uint8Array();
    const view = new DataView(payload.buffer, payload.byteOffset, payload.byteLength);
    const count = view.getUint32(0, true);
    return payload.slice(4, Math.min(payload.length, 4 + count));
}

function parseMtpPropListValue(view, bytes, offset, datatype) {
    const ensure = n => {
        if (offset + n > bytes.length) throw new Error("GetObjectPropList value is truncated.");
    };

    switch (datatype) {
        case 0x0001: // INT8
            ensure(1); return { value: view.getInt8(offset), offset: offset + 1 };
        case 0x0002: // UINT8
            ensure(1); return { value: view.getUint8(offset), offset: offset + 1 };
        case 0x0003: // INT16
            ensure(2); return { value: view.getInt16(offset, true), offset: offset + 2 };
        case 0x0004: // UINT16
            ensure(2); return { value: view.getUint16(offset, true), offset: offset + 2 };
        case 0x0005: // INT32
            ensure(4); return { value: view.getInt32(offset, true), offset: offset + 4 };
        case 0x0006: // UINT32
            ensure(4); return { value: view.getUint32(offset, true) >>> 0, offset: offset + 4 };
        case 0x0007: // INT64
            ensure(8); return { value: Number(view.getBigInt64(offset, true)), offset: offset + 8 };
        case 0x0008: // UINT64
            ensure(8); return { value: Number(view.getBigUint64(offset, true)), offset: offset + 8 };
        case 0x0009: // INT128
        case 0x000A: // UINT128
            ensure(16); return { value: bytes.slice(offset, offset + 16), offset: offset + 16 };
        case 0xFFFF: { // STRING
            const result = decodeMtpString(view, offset);
            return { value: result.value, offset: result.offset };
        }
        default:
            throw new Error("Unsupported GetObjectPropList datatype 0x" + datatype.toString(16));
    }
}

function parseMtpObjectPropListDataset(bytes) {
    const view = new DataView(bytes.buffer, bytes.byteOffset, bytes.byteLength);
    let offset = 0;
    const ensure = n => {
        if (offset + n > bytes.length) throw new Error("GetObjectPropList dataset is truncated.");
    };
    const u16 = () => { ensure(2); const v = view.getUint16(offset, true); offset += 2; return v; };
    const u32 = () => { ensure(4); const v = view.getUint32(offset, true) >>> 0; offset += 4; return v; };

    if (bytes.length < 4) throw new Error("GetObjectPropList dataset is empty.");
    const count = u32();
    const entries = [];

    for (let i = 0; i < count; i++) {
        const objectHandle = u32();
        const propertyCode = u16();
        const datatype = u16();
        const parsed = parseMtpPropListValue(view, bytes, offset, datatype);
        offset = parsed.offset;
        entries.push({ objectHandle, propertyCode, datatype, value: parsed.value });
    }

    return entries;
}

async function mtpGetObjectPropList(objectHandle, objectFormat, propertyCode, groupCode = 0, depth = 0xFFFFFFFF) {
    transactionId++;
    const tx = transactionId;

    await bulkWrite(buildMtpCommand(
        MTP_GET_OBJECT_PROP_LIST,
        tx,
        [objectHandle, objectFormat, propertyCode, groupCode, depth]
    ));

    const dataBytes = await receiveContainer();
    const data = parseContainer(dataBytes);
    if (data.type !== MTP_DATA) throw new Error("GetObjectPropList did not return DATA.");
    if (data.transactionId !== tx) throw new Error("GetObjectPropList transaction mismatch.");

    const entries = parseMtpObjectPropListDataset(data.payload);
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("GetObjectPropList response transaction mismatch.");
    return entries;
}

async function mtpGetObjectPropListForFormat(objectFormat, propertyCode) {
    try {
        return await mtpGetObjectPropList(0xFFFFFFFF, objectFormat, propertyCode, 0, 0xFFFFFFFF);
    } catch (firstError) {
        // Some older MTP responders reject the format filter. Retry once with
        // format 0 and let the caller filter the returned object handles.
        musicLog("GetObjectPropList format filter failed; retrying without a format filter.");
        try {
            return await mtpGetObjectPropList(0xFFFFFFFF, 0, propertyCode, 0, 0xFFFFFFFF);
        } catch (_) {
            throw firstError;
        }
    }
}

function buildPropMap(entries, allowedHandles = null) {
    const map = new Map();
    for (const entry of entries) {
        if (allowedHandles && !allowedHandles.has(entry.objectHandle)) continue;
        map.set(entry.objectHandle, entry.value);
    }
    return map;
}

async function mtpGetObjectReferences(objectHandle) {
    const payload = await mtpGetObjectPropValue(objectHandle, MTP_GET_OBJECT_REFERENCES);
    return payload;
}

async function mtpGetObjectReferencesProper(objectHandle) {
    transactionId++;
    const tx = transactionId;
    await bulkWrite(buildMtpCommand(MTP_GET_OBJECT_REFERENCES, tx, [objectHandle]));
    const dataBytes = await receiveContainer();
    const data = parseContainer(dataBytes);
    if (data.type !== MTP_DATA) throw new Error("GetObjectReferences did not return DATA.");
    if (data.transactionId !== tx) throw new Error("GetObjectReferences transaction mismatch.");
    const payload = data.payload;
    const refs = [];
    if (payload.length >= 4) {
        const view = new DataView(payload.buffer, payload.byteOffset, payload.byteLength);
        const count = view.getUint32(0, true);
        for (let i = 0; i < count && 4 + i * 4 + 4 <= payload.length; i++) {
            refs.push(view.getUint32(4 + i * 4, true) >>> 0);
        }
    }
    await receiveResponse();
    return refs;
}

async function mtpGetObject(objectHandle) {
    transactionId++;
    const tx = transactionId;
    await bulkWrite(buildMtpCommand(MTP_GET_OBJECT, tx, [objectHandle]));
    const dataBytes = await receiveContainer();
    const data = parseContainer(dataBytes);
    if (data.type !== MTP_DATA) throw new Error("GetObject did not return DATA.");
    if (data.transactionId !== tx) throw new Error("GetObject transaction mismatch.");
    await receiveResponse();
    return data.payload.slice();
}

async function mtpGetObjectToWritable(objectHandle, onChunk, knownSize = 0) {
    transactionId++;
    const tx = transactionId;
    await bulkWrite(buildMtpCommand(MTP_GET_OBJECT, tx, [objectHandle]));

    const firstChunk = await bulkRead(Math.max(mtpBulkInPacketSize || 64, 512));
    if (firstChunk.length < 12) {
        throw new Error("USB response was shorter than the MTP data header.");
    }

    const headerView = new DataView(
        firstChunk.buffer,
        firstChunk.byteOffset,
        firstChunk.byteLength
    );
    const expectedLength = headerView.getUint32(0, true);
    const type = headerView.getUint16(4, true);
    const code = headerView.getUint16(6, true);
    const transaction = headerView.getUint32(8, true);

    if (expectedLength < 12) {
        throw new Error("Invalid MTP data container length: " + expectedLength + " bytes.");
    }
    if (type !== MTP_DATA) {
        throw new Error("GetObject did not return an MTP DATA container.");
    }
    if (code !== MTP_GET_OBJECT) {
        throw new Error("GetObject returned an unexpected data code: 0x" + code.toString(16) + ".");
    }
    if (transaction !== tx) {
        throw new Error("GetObject transaction mismatch.");
    }

    const payloadLength = expectedLength - 12;
    const total = payloadLength || Number(knownSize) || 0;
    let received = 0;

    const firstPayloadLength = Math.min(
        Math.max(0, firstChunk.length - 12),
        payloadLength
    );

    if (firstPayloadLength > 0) {
        const firstPayload = firstChunk.slice(12, 12 + firstPayloadLength);
        await onChunk(firstPayload, firstPayloadLength, total);
        received += firstPayloadLength;
    }

    while (received < payloadLength) {
        const remaining = payloadLength - received;
        const chunk = await bulkRead(Math.max(mtpBulkInPacketSize || 64, 64));

        if (!chunk.length) {
            throw new Error("Zune returned an empty USB packet while the video was still downloading.");
        }

        const amount = Math.min(chunk.length, remaining);
        if (amount > 0) {
            const payload = chunk.slice(0, amount);
            received += amount;
            await onChunk(payload, received, total);
        }
    }

    await receiveResponse();
    return received;
}

async function mtpSetObjectPropString(objectHandle, propertyCode, value) {
    transactionId++;
    const tx = transactionId;
    await bulkWrite(buildMtpCommand(MTP_SET_OBJECT_PROP_VALUE, tx, [objectHandle, propertyCode]));
    await sendData(MTP_SET_OBJECT_PROP_VALUE, tx, encodeMtpString(value));
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("SetObjectPropValue transaction mismatch.");
}

async function mtpSetObjectPropUint16(objectHandle, propertyCode, value) {
    transactionId++;
    const tx = transactionId;
    const payload = new Uint8Array(2);
    new DataView(payload.buffer).setUint16(0, value & 0xFFFF, true);
    await bulkWrite(buildMtpCommand(MTP_SET_OBJECT_PROP_VALUE, tx, [objectHandle, propertyCode]));
    await sendData(MTP_SET_OBJECT_PROP_VALUE, tx, payload);
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("SetObjectPropValue transaction mismatch.");
}

async function mtpSetObjectPropUint32(objectHandle, propertyCode, value) {
    transactionId++;
    const tx = transactionId;
    const payload = new Uint8Array(4);
    new DataView(payload.buffer).setUint32(0, value >>> 0, true);
    await bulkWrite(buildMtpCommand(MTP_SET_OBJECT_PROP_VALUE, tx, [objectHandle, propertyCode]));
    await sendData(MTP_SET_OBJECT_PROP_VALUE, tx, payload);
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("SetObjectPropValue transaction mismatch.");
}

async function mtpSetObjectPropArray(objectHandle, propertyCode, data) {
    transactionId++;
    const tx = transactionId;
    const payload = new Uint8Array(4 + data.length);
    new DataView(payload.buffer).setUint32(0, data.length >>> 0, true);
    payload.set(data, 4);
    await bulkWrite(buildMtpCommand(MTP_SET_OBJECT_PROP_VALUE, tx, [objectHandle, propertyCode]));
    await sendData(MTP_SET_OBJECT_PROP_VALUE, tx, payload);
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("SetObjectPropValue transaction mismatch.");
}

async function mtpSetObjectReferences(objectHandle, references) {
    transactionId++;
    const tx = transactionId;
    const payload = new Uint8Array(4 + references.length * 4);
    const view = new DataView(payload.buffer);
    view.setUint32(0, references.length >>> 0, true);
    references.forEach((handle, index) => view.setUint32(4 + index * 4, handle >>> 0, true));

    await bulkWrite(buildMtpCommand(MTP_SET_OBJECT_REFERENCES, tx, [objectHandle]));
    await sendData(MTP_SET_OBJECT_REFERENCES, tx, payload);
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("SetObjectReferences transaction mismatch.");
}

// Zune root writes use parent object 0. Keep 0xFFFFFFFF for GetObjectHandles
// root enumeration, but pass 0 to SendObjectInfo to match the working Zune
// implementations and avoid Zune's InvalidObjectHandle (0x2016).
async function mtpSendObjectInfo(storageId, parentHandle, objectFormat, size, filename) {
    transactionId++;
    const tx = transactionId;

    const info = buildObjectInfoWithParent({
        storageId,
        objectFormat,
        size,
        filename,
        parentHandle
    });

    musicLog(
        "SendObjectInfo: format=0x" + objectFormat.toString(16).padStart(4, "0") +
        " size=" + size +
        " parent=0x" + (parentHandle >>> 0).toString(16).padStart(8, "0") +
        " dataset=" + info.length + " bytes."
    );
    await bulkWrite(buildMtpCommand(MTP_SEND_OBJECT_INFO, tx, [storageId, parentHandle]));
    await sendData(MTP_SEND_OBJECT_INFO, tx, info);
    const response = await receiveResponse();

    if (response.transactionId !== tx) throw new Error("SendObjectInfo transaction mismatch.");
    if (response.parameters.length < 3) throw new Error("Zune returned no object handle from SendObjectInfo.");

    return {
        storageId: response.parameters[0] >>> 0,
        parentHandle: response.parameters[1] >>> 0,
        objectHandle: response.parameters[2] >>> 0
    };
}

function buildObjectInfoWithParent({
    storageId,
    objectFormat,
    size,
    filename,
    parentHandle = 0xFFFFFFFF,
    sequenceNumber = 0
}) {
    const filenameBytes = encodeMtpString(filename);
    // Match the working Zune Explorer implementation exactly: SendObjectInfo
    // uses empty creation and modification date strings. The Zune accepts
    // the dataset reliably this way; populated dates can provoke 0x2016.
    const emptyString = encodeMtpString("");
    const fixedLength = 52;
    const totalLength = fixedLength + filenameBytes.length + emptyString.length + emptyString.length;
    const out = new Uint8Array(totalLength);
    const view = new DataView(out.buffer);
    let o = 0;

    view.setUint32(o, storageId >>> 0, true); o += 4;
    view.setUint16(o, objectFormat, true); o += 2;
    view.setUint16(o, 0, true); o += 2;
    view.setUint32(o, size >>> 0, true); o += 4;
    view.setUint16(o, 0, true); o += 2;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, parentHandle >>> 0, true); o += 4;
    view.setUint16(o, 0, true); o += 2;
    view.setUint32(o, 0, true); o += 4;
    view.setUint32(o, sequenceNumber >>> 0, true); o += 4;

    out.set(filenameBytes, o); o += filenameBytes.length;
    out.set(emptyString, o); o += emptyString.length;
    out.set(emptyString, o);
    return out;
}

async function mtpSendObject(bytes, onProgress = null) {
    transactionId++;
    const tx = transactionId;

    await bulkWrite(buildMtpCommand(MTP_SEND_OBJECT, tx));

    const header = buildMtpDataHeader(MTP_SEND_OBJECT, tx, bytes.length);
    await bulkWrite(header);

    // Larger WebUSB bulk writes reduce per-chunk promise/transfer overhead.
    // 256 KiB remains comfortably below typical browser/device transfer limits.
    const chunkSize = 256 * 1024;
    let sent = 0;
    while (sent < bytes.length) {
        const end = Math.min(bytes.length, sent + chunkSize);
        await bulkWrite(bytes.subarray(sent, end));
        sent = end;
        if (onProgress) onProgress(sent, bytes.length);
    }

    if ((12 + bytes.length) % 512 === 0) {
        await bulkWrite(new Uint8Array(0));
    }

    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("SendObject transaction mismatch.");
}

async function mtpDeleteObject(objectHandle) {
    transactionId++;
    const tx = transactionId;
    await bulkWrite(buildMtpCommand(MTP_DELETE_OBJECT, tx, [objectHandle]));
    const response = await receiveResponse();
    if (response.transactionId !== tx) throw new Error("DeleteObject transaction mismatch.");
}

async function discoverMusicLibrary() {
    if (!sessionOpen) throw new Error("The Zune MTP session is not open.");

    const storageIds = await getMusicStorageIds();
    if (!storageIds.length) throw new Error("The Zune reported no storage IDs.");
    const storageId = storageIds[0];

    const allHandles = await mtpGetObjectHandles(storageId, 0, 0xFFFFFFFF);
    const infoByHandle = new Map();
    const folders = new Map();
    const songs = [];

    musicLog("Found " + allHandles.length + " MTP object(s) on storage 0x" + storageId.toString(16).padStart(8, "0") + ".");

    let scanned = 0;
    for (const handle of allHandles) {
        scanned++;
        if (scanned === allHandles.length || scanned === 1 || scanned % 10 === 0) {
            setMusicScanState("Reading Zune objects: " + scanned + " / " + allHandles.length);
        }

        try {
            let info = musicObjectInfoCache.get(handle);
            if (!info) {
                info = await mtpGetObjectInfo(handle);
                musicObjectInfoCache.set(handle, info);
            }
            infoByHandle.set(handle, info);
            if (info.objectFormat === MTP_OBJECT_FORMAT_ASSOCIATION) {
                folders.set(handle, info);
                continue;
            }

            if (info.objectFormat !== MTP_OBJECT_FORMAT_MP3 &&
                !(info.filename || "").toLowerCase().endsWith(".mp3")) {
                continue;
            }

            songs.push({
                handle,
                info,
                cacheKey: String(info.compressedSize || 0) + "|" + String(info.filename || "") + "|" + String(info.dateModified || ""),
                album: "",
                albumArtist: "",
                artist: "",
                title: "",
                track: 0,
                genre: "",
                parentFolder: info.parentObject >>> 0
            });
        } catch (error) {
            musicLog("Skipping object 0x" + handle.toString(16) + ": " + (error.message || error));
        }
    }

    const songHandles = new Set(songs.map(song => song.handle));
    let optimizedMetadataLoaded = false;
    let cachedSongCount = 0;

    for (const song of songs) {
        const cached = musicMetadataCache.get(song.handle);
        if (!cached || cached.cacheKey !== song.cacheKey) continue;
        song.title = cached.title;
        song.artist = cached.artist;
        song.album = cached.album;
        song.albumArtist = cached.albumArtist;
        song.genre = cached.genre;
        song.track = cached.track;
        cachedSongCount++;
    }

    if (songs.length && cachedSongCount === songs.length) {
        optimizedMetadataLoaded = true;
        musicLog("Reused cached metadata for " + songs.length + " MP3 track(s); no metadata reread was needed.");
    }

    if (songs.length && !optimizedMetadataLoaded) {
        setMusicScanState("Reading metadata for " + songs.length + " MP3 track(s) in optimized mode...");
        try {
            // GetObjectPropList is specifically intended to avoid one USB/MTP
            // transaction for every {object,property} pair. We request each
            // property once for all MP3 objects instead.
            // Keep the MTP transactions strictly sequential. The Zune's USB/MTP
            // transport is not safe to drive with concurrent transactions.
            const titles = await mtpGetObjectPropListForFormat(MTP_OBJECT_FORMAT_MP3, MTP_OBJECT_PROP_NAME);
            const artists = await mtpGetObjectPropListForFormat(MTP_OBJECT_FORMAT_MP3, MTP_OBJECT_PROP_ARTIST);
            const albums = await mtpGetObjectPropListForFormat(MTP_OBJECT_FORMAT_MP3, MTP_OBJECT_PROP_ALBUM_NAME);
            const albumArtists = await mtpGetObjectPropListForFormat(MTP_OBJECT_FORMAT_MP3, MTP_OBJECT_PROP_ALBUM_ARTIST);
            const genres = await mtpGetObjectPropListForFormat(MTP_OBJECT_FORMAT_MP3, MTP_OBJECT_PROP_GENRE);
            const tracks = await mtpGetObjectPropListForFormat(MTP_OBJECT_FORMAT_MP3, MTP_OBJECT_PROP_TRACK);

            const titleMap = buildPropMap(titles, songHandles);
            const artistMap = buildPropMap(artists, songHandles);
            const albumMap = buildPropMap(albums, songHandles);
            const albumArtistMap = buildPropMap(albumArtists, songHandles);
            const genreMap = buildPropMap(genres, songHandles);
            const trackMap = buildPropMap(tracks, songHandles);

            // If a broken responder returned no metadata entries at all, use
            // the reliable per-object fallback below instead of displaying an
            // empty library.
            if (titleMap.size || artistMap.size || albumMap.size || albumArtistMap.size || trackMap.size) {
                for (const song of songs) {
                    // Keep already-cached values when this particular property
                    // was omitted by the Zune's property-list response.
                    song.title = cleanId3Text(titleMap.get(song.handle) ?? song.title ?? "");
                    song.artist = cleanId3Text(artistMap.get(song.handle) ?? song.artist ?? "");
                    song.album = cleanId3Text(albumMap.get(song.handle) ?? song.album ?? "");
                    song.albumArtist = cleanId3Text(albumArtistMap.get(song.handle) ?? song.albumArtist ?? "");
                    song.genre = cleanId3Text(genreMap.get(song.handle) ?? song.genre ?? "");
                    song.track = Number(trackMap.get(song.handle) ?? song.track ?? 0) || 0;
                    musicMetadataCache.set(song.handle, {
                        cacheKey: song.cacheKey,
                        title: song.title,
                        artist: song.artist,
                        album: song.album,
                        albumArtist: song.albumArtist,
                        genre: song.genre,
                        track: song.track
                    });
                }
                optimizedMetadataLoaded = true;
                musicLog("Optimized metadata read completed with GetObjectPropList.");
            }
        } catch (error) {
            musicLog("Optimized metadata read failed; using compatibility mode: " + (error.message || error));
        }
    }

    if (!optimizedMetadataLoaded) {
        setMusicScanState("Reading metadata for " + songs.length + " MP3 track(s)...");
        for (let i = 0; i < songs.length; i++) {
            const song = songs[i];
            const cached = musicMetadataCache.get(song.handle);
            if (cached && cached.cacheKey === song.cacheKey) continue;

            setMusicScanState("Reading metadata: " + (i + 1) + " / " + songs.length);

            const safeGetString = async code => {
                try { return await mtpGetObjectPropString(song.handle, code); } catch (_) { return ""; }
            };
            const safeGet16 = async code => {
                try { return await mtpGetObjectPropUint16(song.handle, code); } catch (_) { return 0; }
            };

            song.title = await safeGetString(MTP_OBJECT_PROP_NAME);
            song.artist = await safeGetString(MTP_OBJECT_PROP_ARTIST);
            song.album = await safeGetString(MTP_OBJECT_PROP_ALBUM_NAME);
            song.albumArtist = await safeGetString(MTP_OBJECT_PROP_ALBUM_ARTIST);
            song.genre = await safeGetString(MTP_OBJECT_PROP_GENRE);
            song.track = await safeGet16(MTP_OBJECT_PROP_TRACK);
            musicMetadataCache.set(song.handle, {
                cacheKey: song.cacheKey,
                title: song.title,
                artist: song.artist,
                album: song.album,
                albumArtist: song.albumArtist,
                genre: song.genre,
                track: song.track
            });
        }
    }

    const folderNameCache = new Map();
    const folderNameForHandle = async handle => {
        if (!handle || handle === 0xFFFFFFFF) return "";
        if (folderNameCache.has(handle)) return folderNameCache.get(handle);
        const folderInfo = folders.get(handle) || infoByHandle.get(handle);
        const name = folderInfo ? folderInfo.filename : "";
        const resolved = name || "";
        folderNameCache.set(handle, resolved);
        return resolved;
    };

    for (const song of songs) {
        if (!song.album) {
            const immediateFolder = await folderNameForHandle(song.parentFolder);
            song.album = immediateFolder || "Unknown Album";
        }
        if (!song.albumArtist) song.albumArtist = song.artist || "Unknown Artist";
        if (!song.title) song.title = song.info.filename || "Untitled";
        if (!song.artist) song.artist = song.albumArtist || "Unknown Artist";
        song.parentFolder = song.info.parentObject >>> 0;
    }

    const albumMap = new Map();
    for (const song of songs) {
        const key = (song.albumArtist || "Unknown Artist") + "|||" + (song.album || "Unknown Album");
        if (!albumMap.has(key)) {
            albumMap.set(key, {
                album: song.album || "Unknown Album",
                artist: song.albumArtist || "Unknown Artist",
                tracks: []
            });
        }
        albumMap.get(key).tracks.push(song);
    }

    for (const album of albumMap.values()) {
        album.tracks.sort((a, b) => {
            const at = a.track || 0;
            const bt = b.track || 0;
            if (at && bt && at !== bt) return at - bt;
            return String(a.title).localeCompare(String(b.title), undefined, { numeric: true, sensitivity: "base" });
        });
    }

    renderMusicAlbums([...albumMap.values()]);
    setMusicScanState("Read " + songs.length + " MP3 track(s) in " + albumMap.size + " album(s).");
    musicBadge.textContent = albumMap.size + (albumMap.size === 1 ? " album" : " albums");
    return { storageId, songs, albumMap };
}

async function getMusicStorageIds() {
    const ids = [];
    transactionId++;
    const tx = transactionId;
    await bulkWrite(buildMtpCommand(MTP_GET_STORAGE_IDS, tx));
    const dataBytes = await receiveContainer();
    const data = parseContainer(dataBytes);
    if (data.type !== MTP_DATA) throw new Error("GetStorageIDs did not return DATA.");
    const payload = data.payload;
    if (payload.length >= 4) {
        const view = new DataView(payload.buffer, payload.byteOffset, payload.byteLength);
        const count = view.getUint32(0, true);
        for (let i = 0; i < count && 4 + i * 4 + 4 <= payload.length; i++) {
            ids.push(view.getUint32(4 + i * 4, true) >>> 0);
        }
    }
    await receiveResponse();
    return ids;
}

function renderMusicAlbums(albums) {
    musicAlbums.innerHTML = "";
    if (!albums.length) {
        musicAlbums.innerHTML = '<div style="color:#777;font-size:13px;">No MP3 tracks were found on the Zune.</div>';
        return;
    }

    for (const album of albums) {
        const panel = document.createElement("div");
        panel.className = "album-panel collapsed";

        const header = document.createElement("div");
        header.className = "album-panel-header";
        header.title = "Click to expand album";

        const toggle = document.createElement("div");
        toggle.className = "album-panel-toggle";
        toggle.textContent = "▶";

        const title = document.createElement("div");
        title.className = "album-panel-title";
        title.textContent = album.album;

        const headerInfo = document.createElement("div");
        headerInfo.style.flex = "1";
        headerInfo.style.minWidth = "0";

        const artist = document.createElement("div");
        artist.className = "album-panel-artist";
        artist.textContent = album.artist + " · " + album.tracks.length + (album.tracks.length === 1 ? " track" : " tracks");

        headerInfo.appendChild(title);
        headerInfo.appendChild(artist);
        header.appendChild(toggle);
        header.appendChild(headerInfo);

        const deleteAlbum = document.createElement("button");
        deleteAlbum.type = "button";
        deleteAlbum.className = "secondary album-delete-button";
        deleteAlbum.style.padding = "7px 9px";
        deleteAlbum.style.fontSize = "11px";
        deleteAlbum.textContent = "Delete album";
        deleteAlbum.title = "Delete every MP3 in this album from the Zune";
        deleteAlbum.addEventListener("click", async () => {
            await deleteZuneAlbum(album, deleteAlbum);
        });

        header.appendChild(deleteAlbum);
        panel.appendChild(header);

        header.addEventListener("click", (event) => {
            if (event.target.closest("button")) return;
            const collapsed = panel.classList.toggle("collapsed");
            toggle.textContent = collapsed ? "▶" : "▼";
            header.title = collapsed ? "Click to expand album" : "Click to collapse album";
        });

        const list = document.createElement("div");
        list.className = "album-track-list";

        album.tracks.forEach((song, index) => {
            const row = document.createElement("div");
            row.className = "album-track";

            const number = document.createElement("div");
            number.className = "album-track-number";
            number.textContent = song.track ? String(song.track) : String(index + 1);

            const trackTitle = document.createElement("div");
            trackTitle.className = "album-track-title";
            trackTitle.textContent = song.title;
            trackTitle.title = song.artist && song.artist !== album.artist
                ? song.title + " — " + song.artist
                : song.title;

            const action = document.createElement("div");
            action.className = "album-track-file";

            const download = document.createElement("button");
            download.type = "button";
            download.className = "secondary";
            download.style.padding = "7px 9px";
            download.style.fontSize = "11px";
            download.textContent = "Download";
            download.title = "Read this MP3 from the Zune";
            download.addEventListener("click", async () => {
                await downloadZuneTrack(song);
            });

            action.appendChild(download);
            row.appendChild(number);
            row.appendChild(trackTitle);
            row.appendChild(action);
            list.appendChild(row);
        });

        panel.appendChild(list);
        musicAlbums.appendChild(panel);
    }
}


async function mergeDuplicateZuneAlbums() {
    if (!sessionOpen) {
        setMusicScanState("Connect and authenticate the Zune first.");
        return;
    }

    const confirmed = window.confirm(
        "Join duplicate albums on the Zune?\n\n" +
        "Albums with the same album name and album artist will be combined " +
        "into one album object. Their tracks and artwork will be kept.\n\n" +
        "The duplicate album metadata objects will then be removed.\n\n" +
        "The MP3 files themselves will not be deleted."
    );

    if (!confirmed) return;

    const originalText = mergeZuneAlbumsButton ? mergeZuneAlbumsButton.textContent : "";
    if (mergeZuneAlbumsButton) {
        mergeZuneAlbumsButton.disabled = true;
        mergeZuneAlbumsButton.textContent = "Joining...";
    }

    try {
        musicLogOutput.textContent = "";
        musicLog("Reading album objects from the Zune...");
        setMusicScanState("Finding duplicate albums...");

        const storageIds = await getMusicStorageIds();
        if (!storageIds.length) {
            throw new Error("The Zune reported no storage IDs.");
        }

        let storageId = storageIds[0];
        const handles = await mtpGetObjectHandles(storageId, 0, 0xFFFFFFFF);
        const albumGroups = new Map();

        let scanned = 0;
        for (const handle of handles) {
            if (!sessionOpen) {
                throw new Error("The Zune disconnected while reading album objects.");
            }

            scanned++;
            setMusicScanState("Reading album objects: " + scanned + " / " + handles.length);

            try {
                const info = await mtpGetObjectInfo(handle);
                if (info.objectFormat !== MTP_OBJECT_FORMAT_ABSTRACT_AUDIO_ALBUM) continue;

                let name = "";
                let artist = "";

                try {
                    name = cleanId3Text(await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_NAME));
                } catch (_) {}

                try {
                    artist = cleanId3Text(await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_ARTIST));
                } catch (_) {}

                if (!name) continue;
                if (!artist) artist = "Unknown Artist";

                const key = musicAlbumKey(artist, name);
                if (!albumGroups.has(key)) {
                    albumGroups.set(key, {
                        key,
                        name,
                        artist,
                        handles: []
                    });
                }

                albumGroups.get(key).handles.push(handle);
            } catch (error) {
                musicLog(
                    "Could not inspect album object 0x" +
                    handle.toString(16).padStart(8, "0") +
                    ": " + (error.message || error)
                );
            }

            await yieldToBrowser();
        }

        const duplicateGroups = [...albumGroups.values()].filter(group => group.handles.length > 1);
        const totalDuplicateObjects = duplicateGroups.reduce(
            (sum, group) => sum + group.handles.length - 1,
            0
        );

        musicLog(
            "Found " + albumGroups.size + " unique album name/artist group(s) and " +
            totalDuplicateObjects + " duplicate album object(s) to join."
        );

        if (!duplicateGroups.length) {
            musicLog("No duplicate albums were found. Nothing needs to be joined.");
            setMusicScanState("No duplicate albums found.");
            return;
        }

        let groupsProcessed = 0;
        let duplicatesDeleted = 0;

        for (const group of duplicateGroups) {
            if (!sessionOpen) {
                throw new Error("The Zune disconnected while joining albums.");
            }

            groupsProcessed++;
            const keeper = group.handles[0];
            const duplicates = group.handles.slice(1);

            musicLog(
                "Joining album " + groupsProcessed + " / " + duplicateGroups.length +
                ": " + group.name + " — " + group.artist +
                " (" + group.handles.length + " album objects)"
            );

            const allReferences = [];
            let keeperArtwork = new Uint8Array(0);

            try {
                keeperArtwork = await mtpGetObjectPropArray(
                    keeper,
                    MTP_OBJECT_PROP_REP_SAMPLE_DATA
                );
            } catch (_) {}

            for (const albumHandle of group.handles) {
                if (!sessionOpen) {
                    throw new Error("The Zune disconnected while reading album references.");
                }

                try {
                    const refs = await mtpGetObjectReferencesProper(albumHandle);
                    allReferences.push(...refs);
                    musicLog(
                        "  Album object 0x" + albumHandle.toString(16).padStart(8, "0") +
                        " contains " + refs.length + " track reference(s)."
                    );
                } catch (error) {
                    musicLog(
                        "  Could not read references from album object 0x" +
                        albumHandle.toString(16).padStart(8, "0") +
                        ": " + (error.message || error)
                    );
                }

                if (!keeperArtwork.length && albumHandle !== keeper) {
                    try {
                        const artwork = await mtpGetObjectPropArray(
                            albumHandle,
                            MTP_OBJECT_PROP_REP_SAMPLE_DATA
                        );
                        if (artwork.length) keeperArtwork = artwork;
                    } catch (_) {}
                }
            }

            const mergedReferences = [...new Set(allReferences)];
            await mtpSetObjectReferences(keeper, mergedReferences);

            musicLog(
                "  Kept album object 0x" + keeper.toString(16).padStart(8, "0") +
                " with " + mergedReferences.length + " unique track reference(s)."
            );

            if (keeperArtwork.length) {
                try {
                    const currentArtwork = await mtpGetObjectPropArray(
                        keeper,
                        MTP_OBJECT_PROP_REP_SAMPLE_DATA
                    );
                    if (!currentArtwork.length && keeperArtwork.length) {
                        const payload = new Uint8Array(4 + keeperArtwork.length);
                        const view = new DataView(payload.buffer);
                        view.setUint32(0, keeperArtwork.length >>> 0, true);
                        payload.set(keeperArtwork, 4);

                        transactionId++;
                        const tx = transactionId;
                        await bulkWrite(buildMtpCommand(
                            MTP_SET_OBJECT_PROP_VALUE,
                            tx,
                            [keeper, MTP_OBJECT_PROP_REP_SAMPLE_DATA]
                        ));
                        await sendData(MTP_SET_OBJECT_PROP_VALUE, tx, payload);
                        const response = await receiveResponse();
                        if (response.transactionId !== tx) {
                            throw new Error("Album artwork merge transaction mismatch.");
                        }
                        musicLog("  Preserved album artwork on the kept album object.");
                    }
                } catch (error) {
                    musicLog(
                        "  Could not preserve album artwork: " +
                        (error.message || error)
                    );
                }
            }

            for (const duplicateHandle of duplicates) {
                if (!sessionOpen) {
                    throw new Error("The Zune disconnected while removing duplicate albums.");
                }

                try {
                    await mtpDeleteObject(duplicateHandle);
                    duplicatesDeleted++;
                    musicLog(
                        "  Removed duplicate album object 0x" +
                        duplicateHandle.toString(16).padStart(8, "0") +
                        " (" + duplicatesDeleted + " / " + totalDuplicateObjects + ")."
                    );
                } catch (error) {
                    musicLog(
                        "  Could not remove duplicate album object 0x" +
                        duplicateHandle.toString(16).padStart(8, "0") +
                        ": " + (error.message || error)
                    );
                }

                await yieldToBrowser();
            }

            await yieldToBrowser();
        }

        musicLog(
            "Album joining completed. Removed " +
            duplicatesDeleted + " duplicate album object(s)."
        );
        setMusicScanState(
            "Album joining complete. " +
            duplicatesDeleted + " duplicate album object(s) removed. Re-reading the library..."
        );
        await discoverMusicLibrary();
    } catch (error) {
        musicLog("Album joining failed: " + (error.message || error));
        setMusicScanState("Album joining failed: " + (error.message || error));
        throw error;
    } finally {
        if (mergeZuneAlbumsButton) {
            mergeZuneAlbumsButton.disabled = false;
            mergeZuneAlbumsButton.textContent = originalText || "Join duplicate albums";
        }
    }
}

async function clearAllZuneMusic() {
    if (!sessionOpen) {
        setMusicScanState("Connect and authenticate the Zune first.");
        return;
    }

    const confirmed = window.confirm(
        "Clear all music from the Zune?\n\n" +
        "This permanently deletes every MP3 track and the music album/artist " +
        "metadata objects currently on the music storage.\n\n" +
        "This cannot be undone."
    );

    if (!confirmed) return;

    const originalText = clearZuneMusicButton ? clearZuneMusicButton.textContent : "";
    if (clearZuneMusicButton) {
        clearZuneMusicButton.disabled = true;
        clearZuneMusicButton.textContent = "Clearing...";
    }

    try {
        musicLogOutput.textContent = "";
        musicLog("Reading the Zune music storage...");
        setMusicScanState("Finding music on the Zune...");

        const storageIds = await getMusicStorageIds();
        if (!storageIds.length) {
            throw new Error("The Zune reported no storage IDs.");
        }

        const storageId = storageIds[0];
        const handles = await mtpGetObjectHandles(storageId, 0, 0xFFFFFFFF);

        const mp3Handles = [];
        const albumHandles = [];
        const artistHandles = [];

        for (const handle of handles) {
            try {
                const info = await mtpGetObjectInfo(handle);
                const filename = String(info.filename || "").toLowerCase();

                if (
                    info.objectFormat === MTP_OBJECT_FORMAT_MP3 ||
                    filename.endsWith(".mp3")
                ) {
                    mp3Handles.push(handle);
                } else if (info.objectFormat === MTP_OBJECT_FORMAT_ABSTRACT_AUDIO_ALBUM) {
                    albumHandles.push(handle);
                } else if (info.objectFormat === MTP_OBJECT_FORMAT_ARTIST) {
                    artistHandles.push(handle);
                }
            } catch (error) {
                musicLog(
                    "Could not inspect object 0x" +
                    handle.toString(16).padStart(8, "0") +
                    ": " + (error.message || error)
                );
            }
        }

        const total = mp3Handles.length + albumHandles.length + artistHandles.length;

        musicLog(
            "Found " + mp3Handles.length + " MP3 track(s), " +
            albumHandles.length + " album object(s), and " +
            artistHandles.length + " artist object(s)."
        );

        if (!total) {
            musicLog("The Zune music storage is already empty.");
            setMusicScanState("The Zune already has no music.");
            return;
        }

        let deleted = 0;

        // Delete tracks first so album references become empty.
        for (const handle of mp3Handles) {
            if (!sessionOpen) {
                throw new Error("The Zune disconnected while clearing music.");
            }

            await mtpDeleteObject(handle);
            deleted++;

            musicLog(
                "Deleted track " + deleted + " / " + total + "."
            );
            setMusicScanState(
                "Clearing music: " + deleted + " / " + total
            );

            await yieldToBrowser();
        }

        // Then remove the synthetic album objects created by this manager.
        for (const handle of albumHandles) {
            if (!sessionOpen) {
                throw new Error("The Zune disconnected while clearing music.");
            }

            try {
                await mtpDeleteObject(handle);
                deleted++;
                musicLog(
                    "Deleted album metadata object " +
                    deleted + " / " + total + "."
                );
                setMusicScanState(
                    "Clearing music: " + deleted + " / " + total
                );
            } catch (error) {
                musicLog(
                    "Could not delete album object 0x" +
                    handle.toString(16).padStart(8, "0") +
                    ": " + (error.message || error)
                );
            }

            await yieldToBrowser();
        }

        // Finally remove the synthetic artist objects.
        for (const handle of artistHandles) {
            if (!sessionOpen) {
                throw new Error("The Zune disconnected while clearing music.");
            }

            try {
                await mtpDeleteObject(handle);
                deleted++;
                musicLog(
                    "Deleted artist metadata object " +
                    deleted + " / " + total + "."
                );
                setMusicScanState(
                    "Clearing music: " + deleted + " / " + total
                );
            } catch (error) {
                musicLog(
                    "Could not delete artist object 0x" +
                    handle.toString(16).padStart(8, "0") +
                    ": " + (error.message || error)
                );
            }

            await yieldToBrowser();
        }

        musicLog("Music clear completed.");
        setMusicScanState(
            "Music cleared. " + deleted + " object(s) processed."
        );

        // Refresh the displayed library so it immediately shows empty.
        await discoverMusicLibrary();
    } catch (error) {
        musicLog("Music clear failed: " + (error.message || error));
        setMusicScanState(
            "Music clear failed: " + (error.message || error)
        );
        throw error;
    } finally {
        if (clearZuneMusicButton) {
            clearZuneMusicButton.disabled = false;
            clearZuneMusicButton.textContent = originalText || "Clear all music";
        }
    }
}

async function deleteZuneAlbum(album, button) {
    if (!sessionOpen) {
        setMusicScanState("Connect and authenticate the Zune first.");
        return;
    }

    const trackCount = album.tracks.length;
    const confirmed = window.confirm(
        'Delete "' + album.album + '" by ' + album.artist + '?\\n\\n' +
        "This will permanently delete " + trackCount +
        (trackCount === 1 ? " track" : " tracks") + " from the Zune."
    );
    if (!confirmed) return;

    const originalText = button.textContent;
    button.disabled = true;
    button.textContent = "Deleting...";

    try {
        musicLog("Deleting album: " + album.album + " — " + album.artist);
        setMusicScanState("Deleting album: " + album.album + "...");

        // Delete the actual MP3 objects first. The music library shown by the
        // Zune is built from these objects, so this is what removes the songs.
        let deletedTracks = 0;
        for (const song of album.tracks) {
            musicLog(
                "Deleting track " + (deletedTracks + 1) + " / " + trackCount +
                ": " + (song.title || song.info.filename || "Untitled")
            );
            await mtpDeleteObject(song.handle);
            deletedTracks++;
            setMusicScanState(
                "Deleting " + album.album + ": " + deletedTracks + " / " + trackCount
            );
        }

        // Remove the corresponding AbstractAudioAlbum object if the Zune
        // created/retained one. This prevents an empty album metadata object
        // from being left behind after its tracks are deleted.
        try {
            const storageIds = await getMusicStorageIds();
            if (storageIds.length) {
                const handles = await mtpGetObjectHandles(storageIds[0], 0, 0xFFFFFFFF);

                for (const handle of handles) {
                    try {
                        const info = await mtpGetObjectInfo(handle);
                        if (info.objectFormat !== MTP_OBJECT_FORMAT_ABSTRACT_AUDIO_ALBUM) continue;

                        let name = "";
                        let artist = "";
                        try { name = await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_NAME); } catch (_) {}
                        try { artist = await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_ARTIST); } catch (_) {}

                        if (
                            String(name).trim() === String(album.album).trim() &&
                            String(artist).trim() === String(album.artist).trim()
                        ) {
                            musicLog("Deleting album metadata object 0x" + handle.toString(16).padStart(8, "0") + ".");
                            await mtpDeleteObject(handle);
                        }
                    } catch (_) {
                        // A stale or unsupported metadata object must not make
                        // the actual track deletion appear to have failed.
                    }
                }
            }
        } catch (error) {
            musicLog("Album metadata cleanup skipped: " + (error.message || error));
        }

        musicLog("Album deleted: " + album.album + " — " + album.artist);
        setMusicScanState("Deleted album: " + album.album + ".");
        await discoverMusicLibrary();
    } catch (error) {
        musicLog("Album deletion failed: " + (error.message || error));
        setMusicScanState("Album deletion failed: " + (error.message || error));
        button.disabled = false;
        button.textContent = originalText;
    }
}

async function downloadZuneTrack(song) {
    try {
        setMusicScanState("Reading MP3 from Zune: " + song.title + "...");
        musicLog("Downloading: " + (song.info.filename || song.title));

        const bytes = await mtpGetObject(song.handle);
        const blob = new Blob([bytes], { type: "audio/mpeg" });
        const url = URL.createObjectURL(blob);
        const link = document.createElement("a");
        link.href = url;
        link.download = safeFilename(song.info.filename || (song.title + ".mp3"), "track.mp3");
        document.body.appendChild(link);
        link.click();
        link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 1000);

        musicLog("Downloaded " + bytes.length + " bytes.");
        setMusicScanState("Finished reading " + song.title + " from the Zune.");
    } catch (error) {
        musicLog("Download failed for " + song.title + ": " + (error.message || error));
        setMusicScanState("MP3 download failed.");
    }
}

const uploadedFileMetadataCache = new WeakMap();
const UPLOAD_METADATA_BATCH_SIZE = 8;

async function readUploadedFileMetadata(file) {
    const cached = uploadedFileMetadataCache.get(file);
    if (cached) return cached;

    const promise = (async () => {
        const buffer = await file.arrayBuffer();
        const bytes = new Uint8Array(buffer);
        return {
            bytes,
            metadata: parseMp3Metadata(bytes, file.name),
            sourceFolder: getFileRelativeFolder(file)
        };
    })();

    uploadedFileMetadataCache.set(file, promise);

    try {
        return await promise;
    } catch (error) {
        uploadedFileMetadataCache.delete(file);
        throw error;
    }
}

async function readUploadedFileMetadataBatch(files, onProgress = null) {
    const list = Array.from(files || []).filter(file => /\.mp3$/i.test(file.name));
    const results = new Array(list.length);
    let nextIndex = 0;
    let completed = 0;

    async function worker() {
        while (true) {
            const index = nextIndex++;
            if (index >= list.length) return;

            results[index] = await readUploadedFileMetadata(list[index]);
            completed++;
            if (onProgress) onProgress(completed, list.length, list[index]);
        }
    }

    const workerCount = Math.min(UPLOAD_METADATA_BATCH_SIZE, list.length);
    await Promise.all(Array.from({ length: workerCount }, () => worker()));
    return results;
}

async function collectUploadTracks(files) {
    const tracks = [];
    const mp3Files = Array.from(files || []).filter(file => /\.mp3$/i.test(file.name));
    const parsedFiles = await readUploadedFileMetadataBatch(mp3Files, (completed, total) => {
        if (total >= 10 && (completed === total || completed % 10 === 0)) {
            setMusicScanState("Preparing music files: " + completed + " / " + total);
        }
    });

    for (let i = 0; i < mp3Files.length; i++) {
        const file = mp3Files[i];
        const parsed = parsedFiles[i];
        const metadata = parsed.metadata;
        const album = detectAlbumForFile(metadata, file);
        const albumArtist = detectAlbumArtist(metadata);
        const title = metadata.title || file.name.replace(/\.mp3$/i, "");
        tracks.push({
            file,
            bytes: parsed.bytes,
            title,
            artist: cleanId3Text(metadata.artist) || albumArtist || "Unknown Artist",
            album,
            albumArtist,
            track: metadata.track || 0,
            genre: cleanId3Text(metadata.genre),
            year: cleanId3Text(metadata.year),
            artwork: metadata.artwork || null,
            sourceFolder: parsed.sourceFolder,
            hasEmbeddedMetadata: !!(
                cleanId3Text(metadata.title) &&
                cleanId3Text(metadata.album) &&
                (cleanId3Text(metadata.albumArtist) || cleanId3Text(metadata.artist))
            )
        });
    }
    return tracks;
}

function groupUploadTracksByAlbum(tracks) {
    const map = new Map();
    for (const track of tracks) {
        const key = musicAlbumKey(track.albumArtist, track.album);
        if (!map.has(key)) {
            map.set(key, {
                key,
                album: track.album,
                artist: track.albumArtist,
                genre: track.genre || "",
                artwork: null,
                tracks: []
            });
        }
        const group = map.get(key);
        if (!group.genre && track.genre) group.genre = track.genre;
        group.tracks.push(track);
    }

    for (const album of map.values()) {
        album.tracks.sort((a, b) => {
            if (a.track && b.track && a.track !== b.track) return a.track - b.track;
            return String(a.file.name).localeCompare(String(b.file.name), undefined, { numeric: true, sensitivity: "base" });
        });

        // Album artwork always comes from the first track in the album.
        // Do not search the selected folder for cover.jpg, folder.jpg, etc.
        album.artwork = album.tracks.length ? (album.tracks[0].artwork || null) : null;
    }

    return [...map.values()];
}

async function discoverExistingMusicEntities(storageId, selectedAlbums = []) {
    const result = {
        artists: new Map(),
        albums: new Map(),
        trackAlbums: new Set()
    };

    try {
        // Preparation used to read 3-6 properties from every MP3 on the Zune.
        // That is extremely slow because each property is an MTP transaction.
        // Album objects already contain the exact name/artist pair we need for
        // the normal duplicate-album check, so inspect those first and only do
        // the expensive MP3 fallback when an album object is missing.
        const allHandles = await mtpGetObjectHandles(storageId, 0, 0xFFFFFFFF);
        const albumHandles = [];
        const artistHandles = [];
        const mp3Handles = [];

        for (const handle of allHandles) {
            try {
                const info = await mtpGetObjectInfo(handle);
                const filename = String(info.filename || "").toLowerCase();

                if (info.objectFormat === MTP_OBJECT_FORMAT_ABSTRACT_AUDIO_ALBUM) {
                    albumHandles.push(handle);
                } else if (info.objectFormat === MTP_OBJECT_FORMAT_ARTIST) {
                    artistHandles.push(handle);
                } else if (
                    info.objectFormat === MTP_OBJECT_FORMAT_MP3 ||
                    filename.endsWith(".mp3")
                ) {
                    mp3Handles.push(handle);
                }
            } catch (_) {}
        }

        for (const handle of artistHandles) {
            try {
                const name = cleanId3Text(
                    await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_NAME)
                );
                if (name && !result.artists.has(name)) {
                    result.artists.set(name, handle);
                }
            } catch (_) {}
        }

        for (const handle of albumHandles) {
            try {
                const name = cleanId3Text(
                    await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_NAME)
                );
                if (!name) continue;

                let artist = "";
                try {
                    artist = cleanId3Text(
                        await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_ARTIST)
                    );
                } catch (_) {}

                if (!artist) artist = "Unknown Artist";
                const key = musicAlbumKey(artist, name);

                if (!result.albums.has(key)) result.albums.set(key, []);
                result.albums.get(key).push(handle);
            } catch (_) {}
        }

        // If every selected album already has an album object, there is no
        // reason to inspect MP3 metadata at all. This is the common case and
        // makes the preparation phase dramatically faster.
        const missingAlbumKeys = new Set();
        for (const album of selectedAlbums) {
            if (!result.albums.has(album.key)) missingAlbumKeys.add(album.key);
        }

        if (missingAlbumKeys.size && mp3Handles.length) {
            musicLog(
                "Checking existing MP3 metadata only because " +
                missingAlbumKeys.size + " selected album(s) have no album object."
            );

            for (let i = 0; i < mp3Handles.length; i++) {
                const handle = mp3Handles[i];
                try {
                    let album = "";
                    let albumArtist = "";
                    let artist = "";

                    try {
                        album = cleanId3Text(
                            await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_ALBUM_NAME)
                        );
                    } catch (_) {}
                    if (!album) continue;

                    try {
                        albumArtist = cleanId3Text(
                            await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_ALBUM_ARTIST)
                        );
                    } catch (_) {}
                    try {
                        artist = cleanId3Text(
                            await mtpGetObjectPropString(handle, MTP_OBJECT_PROP_ARTIST)
                        );
                    } catch (_) {}

                    const resolvedArtist = albumArtist || artist || "Unknown Artist";
                    const key = musicAlbumKey(resolvedArtist, album);
                    if (missingAlbumKeys.has(key)) result.trackAlbums.add(key);
                } catch (_) {}

                if (mp3Handles.length >= 10 && (i + 1) % 10 === 0) {
                    setMusicScanState(
                        "Checking existing music: " + (i + 1) + " / " + mp3Handles.length
                    );
                }
            }
        }
    } catch (error) {
        musicLog("Existing album discovery failed: " + (error.message || error));
    }

    return result;
}

async function createOrReuseArtist(storageId, artistName, entities) {
    const normalizedName = cleanId3Text(artistName) || "Unknown Artist";
    const existing = entities.artists.get(normalizedName);
    if (existing) return existing;

    const created = await mtpSendObjectInfo(
        storageId,
        0,
        MTP_OBJECT_FORMAT_ARTIST,
        0,
        safeFilename(normalizedName + ".art", "artist.art")
    );
    await mtpSendObject(new Uint8Array(0));

    try {
        await mtpSetObjectPropString(
            created.objectHandle,
            MTP_OBJECT_PROP_NAME,
            normalizedName
        );
    } catch (_) {}

    entities.artists.set(normalizedName, created.objectHandle);
    return created.objectHandle;
}

async function setZuneAlbumArtwork(albumHandle, artwork) {
    if (!artwork || !artwork.bytes || !artwork.bytes.length) return false;

    // Zune's Abstract Audio Album (0xBA03) exposes RepresentativeSampleData
    // (0xDC86) as an AUINT8 property.  The observed Windows/Zune transfer
    // sequence sends ONLY this property after SetObjectReferences.
    //
    // Do not write RepresentativeSampleSize (0xDC82) or the sample
    // dimensions here.  On Zune these are reported as read-only/derived
    // properties, and trying to write them can leave the responder stuck.
    //
    // libmtp likewise sends RepresentativeSampleData with the standard
    // SetObjectPropValue operation using datatype AUINT8.
    if (artwork.mime !== "image/jpeg" && artwork.mime !== "image/jpg") {
        musicLog("First-track artwork is " + artwork.mime + "; Zune album artwork transfer requires JPEG.");
        return false;
    }

    transactionId++;
    const tx = transactionId;
    const payload = new Uint8Array(4 + artwork.bytes.length);
    const view = new DataView(payload.buffer);
    view.setUint32(0, artwork.bytes.length >>> 0, true);
    payload.set(artwork.bytes, 4);

    musicLog(
        "Sending " + artwork.bytes.length +
        " bytes of embedded JPEG artwork with SetObjectPropValue (0xDC86)."
    );

    await bulkWrite(
        buildMtpCommand(
            MTP_SET_OBJECT_PROP_VALUE,
            tx,
            [albumHandle, MTP_OBJECT_PROP_REP_SAMPLE_DATA]
        )
    );
    await sendData(MTP_SET_OBJECT_PROP_VALUE, tx, payload);

    const response = await receiveResponse();
    if (response.transactionId !== tx) {
        throw new Error("Album artwork transaction mismatch.");
    }

    return true;
}

async function createOrReuseAlbum(storageId, albumGroup, entities, trackHandles) {
    const existing = entities.albums.get(albumGroup.key) || [];
    let albumHandle = existing.length ? existing[0] : 0;

    if (!albumHandle) {
        const created = await mtpSendObjectInfo(
            storageId,
            0,
            MTP_OBJECT_FORMAT_ABSTRACT_AUDIO_ALBUM,
            0,
            safeFilename(albumGroup.artist + "--" + albumGroup.album + ".alb", "album.alb")
        );
        await mtpSendObject(new Uint8Array(0));
        albumHandle = created.objectHandle;

        try { await mtpSetObjectPropString(albumHandle, MTP_OBJECT_PROP_NAME, albumGroup.album); } catch (_) {}
        try { await mtpSetObjectPropString(albumHandle, MTP_OBJECT_PROP_ARTIST, albumGroup.artist); } catch (_) {}

        // Keep this album in the in-memory entity map so later 10-track
        // segments reuse the same album object instead of creating another
        // identical album object.
        if (!entities.albums.has(albumGroup.key)) {
            entities.albums.set(albumGroup.key, []);
        }
        if (!entities.albums.get(albumGroup.key).includes(albumHandle)) {
            entities.albums.get(albumGroup.key).push(albumHandle);
        }
    } else if (!entities.albums.has(albumGroup.key)) {
        entities.albums.set(albumGroup.key, [albumHandle]);
    }

    const artistHandle = entities.artists.get(albumGroup.artist);
    if (artistHandle) {
        try { await mtpSetObjectPropUint32(albumHandle, MTP_OBJECT_PROP_ARTIST_ID, artistHandle); } catch (_) {}
    }

    if (albumGroup.genre) {
        try { await mtpSetObjectPropString(albumHandle, MTP_OBJECT_PROP_GENRE, albumGroup.genre); } catch (_) {}
    }

    if (trackHandles.length) {
        // New upload album objects are empty here, so there is no reason to
        // spend an extra MTP transaction reading references before setting them.
        await mtpSetObjectReferences(albumHandle, [...new Set(trackHandles)]);
    }

    // Zune/Windows sends album references first and RepresentativeSampleData
    // second. Keep that ordering exactly.
    if (albumGroup.artwork) {
        try {
            musicLog("Using artwork embedded in first track: " + albumGroup.tracks[0].file.name);
            if (await setZuneAlbumArtwork(albumHandle, albumGroup.artwork)) {
                musicLog("Album artwork transferred from first track.");
            }
        } catch (error) {
            musicLog("Album artwork transfer failed: " + (error.message || error));
        }
    }

    return albumHandle;
}
const MUSIC_UPLOAD_SEGMENT_SIZE = 25;

function yieldToBrowser() {
    return new Promise(resolve => setTimeout(resolve, 0));
}

async function uploadMusicTracks(files) {
    if (!sessionOpen) throw new Error("Connect and authenticate the Zune before uploading music.");

    setMusicScanState("Preparing music files...");
    const tracks = await collectUploadTracks(files);
    if (!tracks.length) throw new Error("No MP3 files were selected.");

    const albums = groupUploadTracksByAlbum(tracks);
    const storageIds = await getMusicStorageIds();
    if (!storageIds.length) throw new Error("The Zune reported no storage IDs.");
    let storageId = storageIds[0];

    musicTransferStarted();

    try {
        musicLogOutput.textContent = "";
        musicLog("Prepared " + tracks.length + " MP3 track(s) across " + albums.length + " album(s).");
        musicLog("Upload mode: " + MUSIC_UPLOAD_SEGMENT_SIZE + " track(s) per segment to keep large transfers stable.");
        musicLog("Album objects are locked to one handle before track transfer so a single album cannot be split across duplicate album objects.");
        musicLog("Pause/resume is safe between songs. A paused transfer can survive a USB unplug/reconnect.");

        const entities = await discoverExistingMusicEntities(storageId, albums);
        const allUploaded = [];
        let skippedAlbums = 0;
        let skippedTracks = 0;
        const pendingAlbums = [];

        for (const album of albums) {
            const albumExists = entities.trackAlbums.has(album.key) || entities.albums.has(album.key);
            if (albumExists) {
                skippedAlbums++;
                skippedTracks += album.tracks.length;
                musicLog("Skipping existing album: " + album.album + " — " + album.artist + " (" + album.tracks.length + " track(s)).");
                continue;
            }
            pendingAlbums.push(album);
        }

        if (!pendingAlbums.length) {
            musicLog("Nothing to upload. All selected albums are already on the Zune.");
            setMusicScanState("Nothing uploaded. " + skippedTracks + " selected track(s) were already present.");
            return;
        }

        /*
         * IMPORTANT:
         *
         * Track transfer is intentionally segmented into groups of 10, but
         * album creation must NOT be segmented. The previous implementation
         * discovered/created albums from each 10-track segment. On the Zune
         * this could result in the same album being represented by multiple
         * AbstractAudioAlbum objects, with the tracks divided between them.
         *
         * Create/reuse exactly one album object for every pending album first,
         * then keep that handle for the entire transfer. Every later segment
         * only adds references to that same handle.
         */
        const albumStates = new Map();

        for (const album of pendingAlbums) {
            await waitForMusicTransferResume();

            musicLog("Preparing album object: " + album.album + " — " + album.artist);
            setMusicScanState("Preparing album objects: " + (albumStates.size + 1) + " / " + pendingAlbums.length);

            let artistHandle = entities.artists.get(album.artist) || 0;
            if (!artistHandle) {
                try {
                    artistHandle = await createOrReuseArtist(storageId, album.artist, entities);
                } catch (error) {
                    musicLog("Artist object unavailable for \"" + album.artist + "\": " + (error.message || error) + "; continuing with track metadata.");
                }
            }

            let albumHandle = 0;
            try {
                albumHandle = await createOrReuseAlbum(storageId, album, entities, []);
            } catch (error) {
                musicLog("Could not prepare album object for \"" + album.album + "\": " + (error.message || error) + "; tracks will still be uploaded.");
            }

            albumStates.set(album.key, {
                album,
                albumHandle,
                artistHandle,
                trackHandles: [],
                artworkApplied: !!album.artwork && !!albumHandle
            });
        }

        const pendingTracks = pendingAlbums.flatMap(album => album.tracks);
        const segmentCount = Math.ceil(pendingTracks.length / MUSIC_UPLOAD_SEGMENT_SIZE);
        let trackIndex = 0;

        for (let segmentIndex = 0; segmentIndex < segmentCount; segmentIndex++) {
            await waitForMusicTransferResume();

            const segmentStart = segmentIndex * MUSIC_UPLOAD_SEGMENT_SIZE;
            const segmentTracks = pendingTracks.slice(segmentStart, segmentStart + MUSIC_UPLOAD_SEGMENT_SIZE);

            musicLog("Starting upload segment " + (segmentIndex + 1) + " / " + segmentCount + " (" + segmentTracks.length + " track(s)).");
            setMusicScanState("Uploading segment " + (segmentIndex + 1) + " / " + segmentCount + ": " + segmentTracks.length + " track(s)");

            const touchedAlbums = new Set();

            for (const track of segmentTracks) {
                await waitForMusicTransferResume();

                const state = albumStates.get(musicAlbumKey(track.albumArtist, track.album));
                if (!state) {
                    throw new Error("Could not find the prepared album object for \"" + track.album + "\".");
                }

                touchedAlbums.add(state);
                trackIndex++;

                const currentTrackLabel =
                    "Uploading segment " + (segmentIndex + 1) + " / " + segmentCount +
                    " — track " + trackIndex + " / " + pendingTracks.length +
                    ": " + track.title;

                musicTransferCurrentTrack = currentTrackLabel;
                musicLog(currentTrackLabel);
                setMusicScanState(currentTrackLabel + " (starting)");

                let completed = false;
                while (!completed) {
                    let created = null;
                    try {
                        await waitForMusicTransferResume();

                        const currentStorageId = storageId;

                        created = await mtpSendObjectInfo(
                            currentStorageId,
                            0,
                            MTP_OBJECT_FORMAT_MP3,
                            track.bytes.length,
                            safeFilename(track.file.name, "track.mp3")
                        );

                        let lastProgressUpdate = -1;
                        await mtpSendObject(track.bytes, (sent, total) => {
                            const percent = Math.round((sent / Math.max(1, total)) * 100);
                            if (percent === 100 || percent >= lastProgressUpdate + 5) {
                                lastProgressUpdate = percent;
                                setMusicScanState(currentTrackLabel + " (" + percent + "%)");
                            }
                        });

                        const handle = created.objectHandle;
                        state.trackHandles.push(handle);
                        allUploaded.push(track);

                        // The Zune 30 does NOT reliably use the MP3's embedded
                        // title as its MTP Name property. The library therefore
                        // needs the explicit NAME write for every track; without
                        // it the track is displayed as the uploaded filename
                        // (for example "1_mp3") instead of its song title.
                        //
                        // Keep the speed optimization for the other metadata:
                        // complete ID3 metadata is left alone, while files with
                        // incomplete tags still receive the full repair below.
                        try { await mtpSetObjectPropString(handle, MTP_OBJECT_PROP_NAME, track.title); } catch (_) {}

                        if (!track.hasEmbeddedMetadata) {
                            try { await mtpSetObjectPropString(handle, MTP_OBJECT_PROP_ARTIST, track.artist); } catch (_) {}
                            try { await mtpSetObjectPropString(handle, MTP_OBJECT_PROP_ALBUM_NAME, track.album); } catch (_) {}
                            try { await mtpSetObjectPropString(handle, MTP_OBJECT_PROP_ALBUM_ARTIST, track.albumArtist); } catch (_) {}
                            if (track.genre) {
                                try { await mtpSetObjectPropString(handle, MTP_OBJECT_PROP_GENRE, track.genre); } catch (_) {}
                            }
                            if (track.track) {
                                try { await mtpSetObjectPropUint16(handle, MTP_OBJECT_PROP_TRACK, track.track); } catch (_) {}
                            }
                        }

                        completed = true;
                    } catch (error) {
                        const message = String(error && error.message ? error.message : error);
                        const connectionFailure = !sessionOpen || /USB|MTP|device|transfer|disconnected|closed|endpoint|network/i.test(message);

                        if (!connectionFailure) throw error;

                        musicLog("USB/MTP connection interrupted on " + track.title + ". Waiting for reconnect...");
                        musicTransferWaitingForReconnect = true;

                        await waitForMusicTransferReconnectOnly();
                        try {
                            const reconnectedStorageIds = await getMusicStorageIds();
                            if (!reconnectedStorageIds.length) {
                                throw new Error("The Zune reported no storage IDs after reconnect.");
                            }
                            storageId = reconnectedStorageIds[0];
                        } catch (storageError) {
                            musicLog("Could not refresh the Zune storage after reconnect: " + (storageError.message || storageError));
                            throw storageError;
                        }

                        if (created && created.objectHandle && sessionOpen) {
                            try { await mtpDeleteObject(created.objectHandle); } catch (_) {}
                        }

                        musicLog("Retrying " + track.title + " from the beginning.");
                    }
                }

            }

            /*
             * Now that this segment's tracks exist, add their references to
             * the already-prepared album objects. The cumulative reference
             * list is used so tracks from earlier segments remain in the same
             * album rather than creating another album object.
             */
            for (const state of touchedAlbums) {
                await waitForMusicTransferResume();

                if (!state.albumHandle) {
                    try {
                        state.albumHandle = await createOrReuseAlbum(
                            storageId,
                            state.album,
                            entities,
                            state.trackHandles
                        );
                    } catch (error) {
                        musicLog("Album object unavailable for \"" + state.album.album + "\": " + (error.message || error) + "; tracks were still uploaded.");
                    }
                } else {
                    try {
                        // state.trackHandles is already the complete cumulative
                        // list for this album. Avoid a GetObjectReferences round
                        // trip on every segment.
                        const merged = [...new Set(state.trackHandles)];
                        await mtpSetObjectReferences(state.albumHandle, merged);

                        musicLog(
                            "Album \"" + state.album.album + "\" now contains " +
                            merged.length + " track reference(s) in one album object."
                        );
                    } catch (error) {
                        musicLog("Could not update album references for \"" + state.album.album + "\": " + (error.message || error));
                    }
                }
            }

            musicLog("Completed upload segment " + (segmentIndex + 1) + " / " + segmentCount + ". " + trackIndex + " / " + pendingTracks.length + " pending track(s) processed.");
            await yieldToBrowser();
        }

        musicLog("Upload complete: " + allUploaded.length + " MP3 track(s) added." +
            (skippedAlbums ? " Skipped " + skippedAlbums + " existing album(s) / " + skippedTracks + " track(s)." : ""));
        setMusicScanState(
            "Upload complete. " + allUploaded.length + " MP3 track(s) added." +
            (skippedAlbums ? " Skipped " + skippedTracks + " track(s) from existing album(s)." : "") +
            " Press Scan Music to refresh the library."
        );
    } finally {
        musicTransferFinished();
    }
}

async function waitForMusicTransferReconnectOnly() {
    while (!sessionOpen) {
        setMusicScanState("Transfer paused — waiting for the Zune to reconnect...");
        await new Promise(resolve => setTimeout(resolve, 500));
    }
    musicTransferWaitingForReconnect = false;
    musicLog("Zune reconnected. Continuing the transfer.");
}

async function withMusicButtonLock(callback) {
    const controls = [scanMusicButton, uploadMusicButton, uploadFolderButton, clearZuneMusicButton, mergeZuneAlbumsButton, musicFileInput, musicFolderInput];
    controls.forEach(control => { if (control) control.disabled = true; });
    try {
        return await callback();
    } finally {
        controls.forEach(control => { if (control) control.disabled = false; });
    }
}

async function scanZuneMusic() {
    await withMusicButtonLock(async () => {
        musicLogOutput.textContent = "";
        musicLog("Reading Zune music library...");
        setMusicScanState("Starting Zune music scan...");
        try {
            await discoverMusicLibrary();
        } catch (error) {
            musicLog("ERROR: " + (error.message || error));
            setMusicScanState("Music scan failed.");
            throw error;
        }
    });
}

async function uploadSelectedMusic() {
    await withMusicButtonLock(async () => {
        try {
            await uploadMusicTracks(musicFileInput.files);
        } catch (error) {
            musicLog("ERROR: " + (error.message || error));
            setMusicScanState("Music upload failed.");
            throw error;
        }
    });
}

async function uploadSelectedMusicFolder() {
    const selectedFiles = getSelectedFolderFiles();
    if (!selectedFiles.length) {
        musicLog("No albums are selected for upload.");
        setMusicScanState("Select at least one album before uploading.");
        return;
    }

    await withMusicButtonLock(async () => {
        try {
            await uploadMusicTracks(selectedFiles);
        } catch (error) {
            musicLog("ERROR: " + (error.message || error));
            setMusicScanState("Music folder upload failed.");
            throw error;
        }
    });
}

function showMusicManager() {
    if (musicCard) musicCard.classList.remove("hidden");
}


/*
 * ----------------------------------------------------------
 * Zune firmware recovery
 * ----------------------------------------------------------
 *
 * Android File Transfer for Linux 4.5 added a Zune firmware
 * upload path using the MTP ObjectFormat UndefinedFirmware,
 * 0xB802, followed by the Microsoft RebootDevice operation
 * 0x9204. This browser implementation follows that same MTP
 * sequence using WebUSB.
 */

function firmwareLog(text) {
    firmwareOutput.textContent +=
        (firmwareOutput.textContent ? "\n" : "") +
        text;
}

function buildMtpDateString(date = new Date()) {
    const pad = n => String(n).padStart(2, "0");
    return (
        date.getUTCFullYear() +
        pad(date.getUTCMonth() + 1) +
        pad(date.getUTCDate()) +
        "T" +
        pad(date.getUTCHours()) +
        pad(date.getUTCMinutes()) +
        pad(date.getUTCSeconds()) +
        ".0Z"
    );
}

function buildObjectInfo({
    storageId,
    objectFormat,
    size,
    filename
}) {
    const filenameBytes = encodeMtpString(filename);
    const dateBytes = encodeMtpString(buildMtpDateString());
    const emptyString = encodeMtpString("");

    // Fixed ObjectInfo fields through SequenceNumber = 52 bytes.
    const fixedLength = 52;
    const totalLength =
        fixedLength +
        filenameBytes.length +
        dateBytes.length +
        dateBytes.length +
        emptyString.length;

    const out = new Uint8Array(totalLength);
    const view = new DataView(out.buffer);
    let o = 0;

    view.setUint32(o, storageId >>> 0, true); o += 4;
    view.setUint16(o, objectFormat, true); o += 2;
    view.setUint16(o, 0, true); o += 2; // ProtectionStatus
    view.setUint32(o, size >>> 0, true); o += 4;
    view.setUint16(o, 0, true); o += 2; // ThumbFormat
    view.setUint32(o, 0, true); o += 4; // ThumbCompressedSize
    view.setUint32(o, 0, true); o += 4; // ThumbPixWidth
    view.setUint32(o, 0, true); o += 4; // ThumbPixHeight
    view.setUint32(o, 0, true); o += 4; // ImagePixWidth
    view.setUint32(o, 0, true); o += 4; // ImagePixHeight
    view.setUint32(o, 0, true); o += 4; // ImageBitDepth
    view.setUint32(o, 0xFFFFFFFF, true); o += 4; // ParentObject
    view.setUint16(o, 0, true); o += 2; // AssociationType
    view.setUint32(o, 0, true); o += 4; // AssociationDescription
    view.setUint32(o, 0, true); o += 4; // SequenceNumber

    out.set(filenameBytes, o); o += filenameBytes.length;
    out.set(emptyString, o); o += emptyString.length;
    out.set(emptyString, o);

    return out;
}

async function receiveDataContainerForOperation(expectedCode, expectedTx) {
    const bytes = await receiveContainer();
    const container = parseContainer(bytes);

    rawResponse.textContent = bytesToHex(bytes);

    if (container.type !== MTP_DATA) {
        throw new Error(
            "Expected MTP DATA container, received " +
            hex(container.type)
        );
    }

    if (container.code !== expectedCode) {
        throw new Error(
            "Unexpected DATA operation " +
            hex(container.code) +
            "; expected " +
            hex(expectedCode)
        );
    }

    if (container.transactionId !== expectedTx) {
        throw new Error(
            "DATA transaction mismatch. Expected " +
            expectedTx +
            ", received " +
            container.transactionId
        );
    }

    return container;
}

async function getStorageIdsForRecovery() {
    transactionId++;
    const tx = transactionId;

    firmwareLog("Requesting MTP storage IDs...");

    await bulkWrite(
        buildMtpCommand(
            MTP_GET_STORAGE_IDS,
            tx
        )
    );

    const data =
        await receiveDataContainerForOperation(
            MTP_GET_STORAGE_IDS,
            tx
        );

    const view = new DataView(
        data.payload.buffer,
        data.payload.byteOffset,
        data.payload.byteLength
    );

    if (view.byteLength < 4) {
        throw new Error("Storage ID response is too short.");
    }

    const count = view.getUint32(0, true);
    const ids = [];

    for (let i = 0; i < count && 4 + i * 4 + 4 <= view.byteLength; i++) {
        ids.push(view.getUint32(4 + i * 4, true));
    }

    await receiveResponse();

    if (!ids.length) {
        throw new Error("The Zune reported no MTP storage IDs.");
    }

    firmwareLog(
        "Storage ID: 0x" +
        ids[0].toString(16).padStart(8, "0")
    );

    return ids[0];
}

async function sendFirmwareObject(file) {
    const buffer = await file.arrayBuffer();
    const firmware = new Uint8Array(buffer);

    if (!firmware.length) {
        throw new Error("The selected firmware file is empty.");
    }

    if (firmware.length > 0xFFFFFFFF) {
        throw new Error("The selected firmware file is too large.");
    }

    const storageId = await getStorageIdsForRecovery();

    transactionId++;
    const infoTx = transactionId;

    const objectInfo = buildObjectInfo({
        storageId,
        objectFormat: MTP_OBJECT_FORMAT_UNDEFINED_FIRMWARE,
        size: firmware.length,
        filename: file.name
    });

    firmwareLog(
        "Sending firmware ObjectInfo as UndefinedFirmware (0xB802)..."
    );
    firmwareLog(
        "File: " + file.name + " (" + firmware.length + " bytes)"
    );

    await bulkWrite(
        buildMtpCommand(
            MTP_SEND_OBJECT_INFO,
            infoTx,
            [
                storageId,
                0xFFFFFFFF
            ]
        )
    );

    // Zune-specific behavior: SendObjectInfo DATA header and body
    // are separate bulk transfers.
    // AFTL 4.5 uses a special Zune path here: the DATA container
    // header is one bulk transfer and the ObjectInfo body is a second
    // bulk transfer. Do this explicitly instead of routing it through
    // the generic DATA helper.
    const infoHeader = buildMtpDataHeader(
        MTP_SEND_OBJECT_INFO,
        infoTx,
        objectInfo.length
    );

    firmwareLog(
        "SendObjectInfo DATA container: " +
        (12 + objectInfo.length) +
        " bytes total; header 12 bytes, ObjectInfo body " +
        objectInfo.length +
        " bytes."
    );

    firmwareLog("SendObjectInfo: sending DATA header separately...");
    await bulkWrite(infoHeader);

    // Match AFTL's separate-bulk-write behavior exactly: send the
    // ObjectInfo body as its own transfer, not as one combined buffer.
    firmwareLog(
        "SendObjectInfo: sending ObjectInfo body separately..."
    );
    await bulkWrite(objectInfo);

    firmwareLog("SendObjectInfo: waiting for device response...");

    const infoResponse = await receiveResponse();

    if (infoResponse.transactionId !== infoTx) {
        throw new Error("SendObjectInfo transaction mismatch.");
    }

    // The Zune returns a 32-byte SendObjectInfo response here.
    // Its first three response parameters are the standard MTP values:
    //   parameter 1 = StorageID
    //   parameter 2 = ParentObject
    //   parameter 3 = ObjectHandle
    // The Zune also appends extra vendor-specific values after those.
    // Do not reject the response merely because it has more than the
    // standard three parameters.
    firmwareLog(
        "SendObjectInfo response: code " +
        hex(infoResponse.code) +
        ", transaction " +
        infoResponse.transactionId +
        ", " +
        infoResponse.parameters.length +
        " parameters."
    );

    firmwareLog(
        "SendObjectInfo parameters: " +
        infoResponse.parameters
            .map((value, index) =>
                "P" + (index + 1) + "=0x" +
                (value >>> 0).toString(16).padStart(8, "0")
            )
            .join(", ")
    );

    // The third parameter is the MTP object handle. Force it through
    // Uint32 so values with the high bit set are still handled correctly.
    let objectHandle =
        infoResponse.parameters.length >= 3
            ? (infoResponse.parameters[2] >>> 0)
            : 0;

    // If the parser ever returns an unexpected parameter layout, read the
    // standard ObjectHandle position directly from the response container.
    // SendObjectInfo puts ObjectHandle at byte offset 20.
    if (!objectHandle || objectHandle === 0xFFFFFFFF) {
        const responseBytes = await Promise.resolve(
            lastReceivedContainerBytes
        );

        if (responseBytes && responseBytes.length >= 24) {
            const responseView = new DataView(
                responseBytes.buffer,
                responseBytes.byteOffset,
                responseBytes.byteLength
            );

            objectHandle = responseView.getUint32(20, true) >>> 0;
        }
    }

    if (!objectHandle || objectHandle === 0xFFFFFFFF) {
        throw new Error(
            "Zune did not return a valid firmware object handle. " +
            "The response parameters were: " +
            infoResponse.parameters
                .map(value => "0x" + (value >>> 0).toString(16).padStart(8, "0"))
                .join(", ")
        );
    }

    firmwareLog(
        "Firmware object handle: 0x" +
        objectHandle.toString(16).padStart(8, "0")
    );

    transactionId++;
    const objectTx = transactionId;

    firmwareLog("Sending firmware data...");

    await bulkWrite(
        buildMtpCommand(
            MTP_SEND_OBJECT,
            objectTx
        )
    );

    // For a large firmware object, keep the DATA header separate and
    // stream the payload in 16 KiB chunks, matching the existing Zune
    // transport implementation.
    await sendData(
        MTP_SEND_OBJECT,
        objectTx,
        firmware,
        { combine: false }
    );

    const objectResponse = await receiveResponse();

    if (objectResponse.transactionId !== objectTx) {
        throw new Error("SendObject transaction mismatch.");
    }

    firmwareLog("Firmware upload completed successfully.");
}

async function rebootZuneAfterFirmware() {
    transactionId++;
    const tx = transactionId;

    firmwareLog("Requesting Zune reboot (0x9204)...");

    await bulkWrite(
        buildMtpCommand(
            MTP_REBOOT_DEVICE,
            tx
        )
    );

    try {
        const response = await receiveResponse();
        if (response.transactionId !== tx) {
            throw new Error("Reboot transaction mismatch.");
        }
    } catch (error) {
        // A reboot can legitimately disconnect the USB transport before
        // the response is observable. Log that separately instead of
        // treating it as proof that the reboot failed.
        firmwareLog(
            "USB disconnected while waiting for the reboot response. " +
            "That can be normal during a successful reboot."
        );
    }
}

async function prepareRecoveryUsbConnection() {
    if (!navigator.usb) {
        throw new Error("WebUSB is not available in this browser.");
    }

    const devices = await navigator.usb.getDevices();
    const matching = devices.filter(
        d => d.vendorId === 0x045E && d.productId === 0x0710
    );

    if (matching.length) {
        zuneDevice = matching[0];
        firmwareLog("Found previously authorized Zune 30.");
    } else {
        firmwareLog("Select the Zune 30 in Chrome's USB chooser.");
        zuneDevice = await navigator.usb.requestDevice({
            filters: [{ vendorId: 0x045E, productId: 0x0710 }]
        });
    }

    if (!zuneDevice.opened) {
        await zuneDevice.open();
    }

    try {
        if (typeof zuneDevice.reset === "function") {
            firmwareLog("Resetting USB state before recovery...");
            await zuneDevice.reset();
            await sleepMs(300);
        }
    } catch (error) {
        firmwareLog(
            "USB reset was not available: " +
            (error.message || error)
        );
    }

    if (!zuneDevice.configuration) {
        await zuneDevice.selectConfiguration(1);
    }

    displayUsbInfo(zuneDevice);
    displayInterfaces(zuneDevice);
    results.classList.remove("hidden");

    const found = findMtpInterface(zuneDevice);
    if (!found) {
        throw new Error("No MTP-compatible USB interface was found.");
    }

    mtpInterfaceNumber = found.interfaceNumber;

    const endpoints = findBulkEndpoints(found.alternate);
    if (!endpoints.input || !endpoints.output) {
        throw new Error("MTP bulk endpoints were not found.");
    }

    mtpBulkInEndpoint = endpoints.input.endpointNumber;
    mtpBulkInPacketSize = endpoints.input.packetSize || 64;
    mtpBulkOutEndpoint = endpoints.output.endpointNumber;

    await zuneDevice.claimInterface(mtpInterfaceNumber);

    if (found.alternateSetting !== 0) {
        await zuneDevice.selectAlternateInterface(
            mtpInterfaceNumber,
            found.alternateSetting
        );
    }

    setConnectionState(true);
}

async function restoreZuneFirmware() {
    const file = firmwareFileInput.files[0];

    if (!file) {
        setStatus("Select the Zune firmware file first.", "error");
        return;
    }

    firmwareOutput.textContent = "";
    restoreFirmwareButton.disabled = true;
    firmwareFileInput.disabled = true;

    try {
        setStatus(
            "Preparing Zune firmware recovery...",
            "working"
        );

        // If the normal connection is already open, reuse it. Otherwise
        // establish a clean USB/MTP connection without attempting MTPZ.
        if (!zuneDevice || !zuneDevice.opened || !mtpInterfaceNumber) {
            await cleanupConnection();
            await prepareRecoveryUsbConnection();
        }

        firmwareLog("Opening MTP session without MTPZ authentication...");
        await openMtpSession();

        await sendFirmwareObject(file);

        setStatus(
            "Firmware uploaded. Rebooting Zune...",
            "working"
        );

        await rebootZuneAfterFirmware();

        firmwareLog("Recovery sequence sent. Wait for the Zune to reboot.");
        firmwareLog("If the screen changes, reconnect and use normal Connect Zune.");

        setStatus(
            "Firmware recovery command sent.",
            "success"
        );
    } catch (error) {
        console.error("Firmware recovery error:", error);
        firmwareLog(
            "ERROR: " +
            (error && error.message ? error.message : String(error))
        );
        setStatus(
            "Firmware recovery failed: " +
            (error && error.message ? error.message : String(error)),
            "error"
        );
    } finally {
        restoreFirmwareButton.disabled = false;
        firmwareFileInput.disabled = false;
    }
}


async function cleanupConnection() {

    if (
        !zuneDevice
    ) {

        setConnectionState(
            false
        );

        return;
    }


    try {

        if (
            sessionOpen
        ) {

            try {

                await closeMtpSession();

            } catch (error) {

                console.warn(
                    "Could not close MTP session:",
                    error
                );
            }
        }


        if (
            mtpInterfaceNumber !==
            null
        ) {

            try {

                await zuneDevice.releaseInterface(
                    mtpInterfaceNumber
                );

            } catch (error) {

                console.warn(
                    "Could not release interface:",
                    error
                );
            }
        }


        try {

            await zuneDevice.close();

        } catch (error) {

            console.warn(
                "Could not close USB device:",
                error
            );
        }

    } finally {

        zuneDevice =
            null;

        mtpInterfaceNumber =
            null;

        mtpBulkInEndpoint =
            null;

        mtpBulkInPacketSize =
            64;

        mtpBulkOutEndpoint =
            null;

        transactionId =
            0;

        sessionOpen =
            false;

        setConnectionState(
            false
        );
    }
}


/*
 * ----------------------------------------------------------
 * Disconnect
 * ----------------------------------------------------------
 */

async function disconnectZune() {

    await cleanupConnection();

    setStatus(
        "Zune disconnected."
    );
}


/*
 * ----------------------------------------------------------
 * Browser USB disconnect
 * ----------------------------------------------------------
 */

if (
    navigator.usb
) {

    navigator.usb.addEventListener(
        "disconnect",
        event => {

            if (
                zuneDevice &&
                event.device ===
                    zuneDevice
            ) {

                cleanupConnection();


                setStatus(
                    "The Zune was disconnected.",
                    "error"
                );
            }
        }
    );
}


/*
 * ----------------------------------------------------------
 * Buttons
 * ----------------------------------------------------------
 */

connectButton.addEventListener(
    "click",
    connectZune
);


disconnectButton.addEventListener(
    "click",
    disconnectZune
);


restoreFirmwareButton.addEventListener(
    "click",
    restoreZuneFirmware
);


scanMusicButton.addEventListener(
    "click",
    async () => {
        try {
            await scanZuneMusic();
        } catch (error) {
            setStatus(
                "Music library read failed: " +
                (error && error.message ? error.message : String(error)),
                "error"
            );
        }
    }
);

uploadMusicButton.addEventListener(
    "click",
    async () => {
        try {
            await uploadSelectedMusic();
        } catch (error) {
            setStatus(
                "MP3 upload failed: " +
                (error && error.message ? error.message : String(error)),
                "error"
            );
        }
    }
);

uploadFolderButton.addEventListener(
    "click",
    async () => {
        try {
            await uploadSelectedMusicFolder();
        } catch (error) {
            setStatus(
                "MP3 folder upload failed: " +
                (error && error.message ? error.message : String(error)),
                "error"
            );
        }
    }
);


scanPicturesButton.addEventListener(
    "click",
    async () => {
        try { await scanZunePictures(); }
        catch (error) {
            setStatus("Picture library read failed: " + (error && error.message ? error.message : String(error)), "error");
        }
    }
);

scanVideosButton.addEventListener("click", async () => {
    try {
        await withVideoButtonLock(() => discoverZuneVideos());
    } catch (error) {
        alert(error && error.message ? error.message : String(error));
    }
});

uploadVideosButton.addEventListener("click", async () => {
    try {
        await withVideoButtonLock(() => uploadVideoFiles(videoFileInput.files));
    } catch (error) {
        videoLog("Upload failed: " + (error && error.message ? error.message : String(error)));
        alert(error && error.message ? error.message : String(error));
    }
});

videoFolderInput.addEventListener("change", () => {
    if (uploadVideoFolderButton) uploadVideoFolderButton.disabled = getSelectedVideoFiles(videoFolderInput).length === 0;
});

uploadVideoFolderButton.addEventListener("click", async () => {
    try {
        await withVideoButtonLock(() => uploadVideoFiles(videoFolderInput.files));
    } catch (error) {
        videoLog("Folder upload failed: " + (error && error.message ? error.message : String(error)));
        alert(error && error.message ? error.message : String(error));
    }
});

pauseVideoTransferButton.addEventListener("click", requestVideoTransferPause);

clearZuneVideosButton.addEventListener("click", async () => {
    try {
        await withVideoButtonLock(() => clearAllZuneVideos());
    } catch (error) {
        videoLog("Clear failed: " + (error && error.message ? error.message : String(error)));
        alert(error && error.message ? error.message : String(error));
    }
});

uploadPicturesButton.addEventListener(
    "click",
    async () => {
        try {
            await withPictureButtonLock(async () => {
                await uploadPictureFiles(pictureFileInput.files);
            });
        } catch (error) {
            setStatus("Picture upload failed: " + (error && error.message ? error.message : String(error)), "error");
        }
    }
);

uploadPictureFolderButton.addEventListener(
    "click",
    async () => {
        try {
            await withPictureButtonLock(async () => {
                await uploadPictureFiles(pictureFolderInput.files);
            });
        } catch (error) {
            setStatus("Picture folder upload failed: " + (error && error.message ? error.message : String(error)), "error");
        }
    }
);

pictureFolderInput.addEventListener("change", () => {
    const files = getSelectedPictureFiles(pictureFolderInput);
    uploadPictureFolderButton.disabled = files.length === 0;
    uploadPictureFolderButton.textContent = files.length
        ? "Upload " + files.length + " picture" + (files.length === 1 ? "" : "s")
        : "Upload picture folder";
});

if (pausePictureTransferButton) {
    pausePictureTransferButton.addEventListener("click", requestPictureTransferPause);
}

clearZunePicturesButton.addEventListener(
    "click",
    async () => {
        try {
            await withPictureButtonLock(async () => {
                await clearAllZunePictures();
            });
        } catch (error) {
            pictureLog("ERROR: " + (error.message || error));
            setPictureScanState("Could not clear pictures: " + (error.message || error));
        }
    }
);


mergeZuneAlbumsButton.addEventListener(
    "click",
    async () => {
        try {
            await withMusicButtonLock(async () => {
                await mergeDuplicateZuneAlbums();
            });
        } catch (error) {
            setStatus(
                "Could not join duplicate albums: " +
                (error && error.message ? error.message : String(error)),
                "error"
            );
        }
    }
);


clearZuneMusicButton.addEventListener(
    "click",
    async () => {
        try {
            await withMusicButtonLock(async () => {
                await clearAllZuneMusic();
            });
        } catch (error) {
            setStatus(
                "Could not clear Zune music: " +
                (error && error.message ? error.message : String(error)),
                "error"
            );
        }
    }
);

musicFolderInput.addEventListener("change", () => {
    prepareFolderAlbumSelection().catch(error => {
        folderAlbumChoices = new Map();
        folderAlbumSelection.classList.add("hidden");
        uploadFolderButton.disabled = true;
        uploadFolderButton.textContent = "Upload selected albums";
        folderAlbumSelectionSummary.textContent = "Could not read the selected folder: " + (error.message || error);
        musicLog("ERROR: " + (error.message || error));
    });
});

selectAllFolderAlbumsButton.addEventListener("click", () => {
    setAllFolderAlbumsSelected(true);
});

selectNoFolderAlbumsButton.addEventListener("click", () => {
    setAllFolderAlbumsSelected(false);
});

if (pauseMusicTransferButton) {
    pauseMusicTransferButton.addEventListener("click", requestMusicTransferPause);
}


/*
 * ----------------------------------------------------------
 * Startup
 * ----------------------------------------------------------
 */

if (
    !navigator.usb
) {

    setStatus(
        "WebUSB is unavailable. Use Chrome on a secure HTTPS page.",
        "error"
    );

} else {

    setStatus(
        "WebUSB is ready. Click Connect Zune."
    );
}

</script>

</body>
</html>