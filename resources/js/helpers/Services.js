export default {
    services : [
        {
            principal_service: 'Audio Engineering',
            especific_service:[
                'Audio Repairing' ,
                'Broadcasting' ,
                'Consultation' ,
                'Equipment Repairing' ,
                'Live Stage Setup' ,
                'Live TV Audio Engineering' ,
                'Mastering' ,
                'Mixing' ,
                'Podcasting' ,
                'Post-Production' ,
                'Radio Engineering' ,
                'Recording' ,
                'Song Re-Mixing' ,
                'Studio Setup' ,   
            ]
        },
        {
            principal_service: 'Music Production',
            especific_service:[
                'Beat Making',
                'Drum Sampling',
                'Editing (Bass Guitar)',
                'Editing (Drums)',
                'Editing (Guitar)',
                'Editing (Samples)',
                'Editing (Vocals)',
                'MIDI Programming',
                'Re-Amping (Bass Guitar)',
                'Re-Amping (Drums)',
                'Re-Amping (Guitar)',
                'Re-Amping (Samples)',
                'Re-Sampling',
                'Sampling',
                'Song Arranging',
                'Song Re-Arranging',
                'Sound Design',
                'Composing',
                'Advertisements Composing',
                'Anime Composing',
                'Cartoon Composing',
                'Film &amp; Cinema Composing',
                'Social Media Videos Composing',
                'Trailers Composing',
                'TV Series Composing',
                'Video Games Composing',
                'YouTube Videos Composing'
            ]
        },
        {
            principal_service:'DJ',
            especific_service:[
                'Bars &amp; Pubs',
                'Ceremonies',
                'Clubs',
                'Dj Remixing',
                'Events (Live)',
                'Events (Pre-Recorded)',
                'House Parties',
                'Touring Hire (National)',
                'Touring Hire (Overseas)',
                'Weddings',
            ]
        },
        {
            principal_service:'Musicians',
            especific_service:[
                'Bars &amp; Pubs',
                'Ceremonies',
                'Clubs',
                'Instruments Repair',
                'Live Session (National)',
                'Live Session (Overseas)',
                'Recording Session',
                'Songwriting',
                'Teacher (Face to Face)',
                'Teacher (Online)',
                'Touring (National)',
                'Touring (Overseas)',
                'Weddings',
            ]
        }
    ],

    getEspecificService(service){
        var ser =  _.find(this.services, ['principal_services', service])
        return ser.especific_service
    },

    getAllServices(){
        return this.services
    }
}
            










        