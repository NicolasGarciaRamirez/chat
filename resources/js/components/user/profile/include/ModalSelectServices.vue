<template>
  <section>
      <div class="modal fade modal-select" tabindex="-1" role="dialog" aria-labelledby="ModalSelectServices" aria-hidden="true" id="ModalSelectServices">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="d-flex flex-column justify-content-start">
                            <h4 class="font-weight-bold">Select Service(s)</h4>
                            <br>
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="AudioEngineering" value="Audio Engineering Music">
                                        <label for="AudioEngineering" class="text-white font-weight-bold">Audio Engineering</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="AudioRepairing" value="Audio Repairing">
                                            <label for="AudioRepairing" class="text-white">Audio Repairing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Broadcasting" value="Broadcasting">
                                            <label for="Broadcasting" class="text-white">Broadcasting</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Consultation" value="Consultation">
                                            <label for="Consultation" class="text-white">Consultation</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="EquipmentRepairing" value="Equipment Repairing">
                                            <label for="EquipmentRepairing" class="text-white">Equipment Repairing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="LiveStageSetup" value="Live Stage Setup">
                                            <label for="LiveStageSetup" class="text-white ">Live Stage Setup</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="LiveTVAudioEngineering" value="Live TV Audio Engineering">
                                            <label for="LiveTVAudioEngineering" class="text-white ">Live TV Audio Engineering</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Mastering" value="Mastering">
                                            <label for="Mastering" class="text-white ">Mastering</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Mixing" value="Mixing">
                                            <label for="Mixing" class="text-white ">Mixing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Podcasting" value="Podcasting">
                                            <label for="Podcasting" class="text-white ">Podcasting</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Post-Production" value="Post-Production">
                                            <label for="Post-Production" class="text-white ">Post-Production</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Radio Engineering" value="Radio Engineering">
                                            <label for="Radio Engineering" class="text-white ">Radio Engineering</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Recording" value="Recording">
                                            <label for="Recording" class="text-white ">Recording</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="SongReMixing" value="Song Re-Mixing">
                                            <label for="SongReMixing" class="text-white ">Song Re-Mixing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="StudioSetup" value="Studio Setup">
                                            <label for="StudioSetup" class="text-white ">Studio Setup</label>
                                        </div>
                                    </div>
                                    <div class="border-top"></div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="MusicProduction" value="Music Production Music">
                                            <label for="MusicProduction" class="text-white font-weight-bold">Music Production</label>
                                        </div>
                                        <div class="d-flex flex-column ml-4">
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="BeatMaking" value="Beat Making">
                                                <label for="BeatMaking" class="text-white ">Beat Making</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="DrumSampling" value="Drum Sampling">
                                                <label for="DrumSampling" class="text-white ">Drum Sampling</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EditingBassGuitar" value="Editing (Bass Guitar)">
                                                <label for="EditingBassGuitar" class="text-white">Editing (Bass Guitar)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EditingDrums" value="Editing (Drums)">
                                                <label for="EditingDrums" class="text-white ">Editing (Drums)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EditingGuitar" value="Editing (Guitar)">
                                                <label for="EditingGuitar" class="text-white ">Editing (Guitar)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EditingSamples" value="Editing (Samples)">
                                                <label for="EditingSamples" class="text-white ">Editing (Samples)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EditingVocals" value="Editing (Vocals)">
                                                <label for="EditingVocals" class="text-white ">Beat Making</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="BeatMaking" value="Editing (Vocals)">
                                                <label for="BeatMaking" class="text-white ">Beat Making</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="MIDIProgramming" value="MIDI Programming">
                                                <label for="MIDIProgramming" class="text-white ">MIDI Programming</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Re-AmpingBassGuitar" value="Re-Amping (Bass Guitar)">
                                                <label for="Re-AmpingBassGuitar" class="text-white ">Re-Amping (Bass Guitar)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Re-AmpingDrums" value="Re-Amping (Drums)">
                                                <label for="Re-AmpingDrums" class="text-white ">Re-Amping (Drums)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Re-AmpingGuitar" value="Re-Amping (Guitar)">
                                                <label for="Re-AmpingGuitar" class="text-white ">Re-Amping (Guitar)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Re-AmpingSamples" value="Re-Amping (Samples)">
                                                <label for="Re-AmpingSamples" class="text-white ">Re-Amping (Samples)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Re-Sampling" value="Re-Sampling">
                                                <label for="Re-Sampling" class="text-white ">Re-Sampling</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Sampling" value="Sampling">
                                                <label for="Sampling" class="text-white ">Sampling</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="BeatMaking" value="Song Arranging">
                                                <label for="BeatMaking" class="text-white ">Song Arranging</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="SongRe-Arranging" value="Song Re-Arranging">
                                                <label for="SongRe-Arranging" class="text-white ">Song Re-Arranging</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="SoundDesign" value="Sound Design">
                                                <label for="SoundDesign" class="text-white ">Sound Design</label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="border-top"></div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <input type="checkbox" id="Composing" value="Composing">
                                        <label for="Composing" class="text-white font-weight-bold">Composing</label>
                                    </div>
                                    <div class="d-flex flex-column ml-4">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="AdvertisementsComposing" value="Advertisements Composing">
                                            <label for="AdvertisementsComposing" class="text-white ">Advertisements Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="AnimeComposing" value="Anime Composing">
                                            <label for="AnimeComposing" class="text-white ">Anime Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Cartoon Composing" value="Cartoon Composing">
                                            <label for="Cartoon Composing" class="text-white ">Cartoon Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Film&CinemaComposing" value="Film & Cinema Composing">
                                            <label for="Film&CinemaComposing" class="text-white ">Film & Cinema Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="SocialMediaVideosComposing" value="Social Media Videos Composing">
                                            <label for="SocialMediaVideosComposing" class="text-white ">Social Media Videos Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="TrailersComposing" value="Trailers Composing">
                                            <label for="TrailersComposing" class="text-white ">Trailers Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="TVSeriesComposing" value="TV Series Composing">
                                            <label for="TVSeriesComposing" class="text-white ">TV Series Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="AdvertisementsComposing" value="Video Games Composing">
                                            <label for="AdvertisementsComposing" class="text-white ">Video Games Composing</label>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="YouTubeVideosComposing" value="YouTube Videos Composing">
                                            <label for="YouTubeVideosComposing" class="text-white ">YouTube Videos Composing</label>
                                        </div>
                                    </div>
                                    <div class="border-top c-third"></div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="DJ" value="DJ">
                                            <label for="DJ" class="text-white font-weight-bold">DJ</label>
                                        </div>
                                        <div class="d-flex flex-column ml-4">
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Bars&Pubs" value="Bars & Pubs">
                                                <label for="Bars&Pubs" class="text-white ">Bars & Pubs</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Ceremonies" value="Ceremonies">
                                                <label for="Ceremonies" class="text-white ">Ceremonies</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Clubs" value="Clubs">
                                                <label for="Clubs" class="text-white ">Clubs</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="DjRemixing" value="Dj Remixing">
                                                <label for="DjRemixing" class="text-white ">Dj Remixing</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EventsLive" value="Events (Live)">
                                                <label for="EventsLive" class="text-white ">Events (Live)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="EventsPre-Recorded" value="Events (Pre-Recorded)">
                                                <label for="EventsPre-Recorded" class="text-white ">Events (Pre-Recorded)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="HouseParties" value="House Parties">
                                                <label for="HouseParties" class="text-white ">House Parties</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="TouringHireNational" value="Touring Hire (National)">
                                                <label for="TouringHireNational" class="text-white ">Touring Hire (National)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="TouringHireOverseas" value="Touring Hire (Overseas)">
                                                <label for="TouringHireOverseas" class="text-white ">Touring Hire (Overseas)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Weddings" value="Weddings">
                                                <label for="Weddings" class="text-white ">Weddings</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top c-third"></div>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex flex-row">
                                            <input type="checkbox" id="Musicians" value="Musicians">
                                            <label for="Musicians" class="text-white font-weight-bold">Musicians</label>
                                        </div>
                                        <div class="d-flex flex-column ml-4">
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Bars&Pubs" value="Bars & Pubs">
                                                <label for="Bars&Pubs" class="text-white ">Bars & Pubs</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Ceremonies" value="Ceremonies">
                                                <label for="Ceremonies" class="text-white ">Ceremonies</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Clubs" value="Clubs">
                                                <label for="Clubs" class="text-white ">Clubs</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="InstrumentsRepair" value="Instruments Repair">
                                                <label for="InstrumentsRepair" class="text-white ">Instruments Repair</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="LiveSessionNational" value="Live Session (National)">
                                                <label for="LiveSessionNational" class="text-white ">Live Session (National)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="LiveSessionOverseas" value="Live Session (Overseas)">
                                                <label for="LiveSessionOverseas" class="text-white ">Live Session (Overseas)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="RecordingSession" value="Recording Session">
                                                <label for="RecordingSession" class="text-white ">Recording Session</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Songwriting" value="Songwriting">
                                                <label for="Songwriting" class="text-white ">Songwriting</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="TeacherFacetoFace" value="Teacher (Face to Face)">
                                                <label for="TeacherFacetoFace" class="text-white ">Teacher (Face to Face)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="TeacherOnline" value="Teacher (Online)">
                                                <label for="TeacherOnline" class="text-white ">Teacher (Online)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="TouringNational" value="Touring (National)">
                                                <label for="TouringNational" class="text-white ">Touring (National)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="TouringOverseas" value="Touring (Overseas)">
                                                <label for="TouringOverseas" class="text-white ">Touring (Overseas)</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <input type="checkbox" id="Weddings" value="Weddings">
                                                <label for="Weddings" class="text-white ">Weddings</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-top c-third"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>
</template>

<script>
export default {

}
</script>
