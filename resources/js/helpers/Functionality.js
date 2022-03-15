export default {
    accordion(...elements){ 
        elements.forEach(element => {
            $(`${element} .card-body`).slideUp()

            $(`${element} .card [data-target]`).on('click', (e) => {
                e.target.parentElement.classList.toggle('active')
                
                let id = e.target.dataset.target

                $(`#${id}`).slideToggle()

            })  
        });
    },  
    ldsRipple(element){
        $(`.${element}`).click( e => {
            let lds = e.target
            let content  = lds.nextElementSibling
            let parent = lds.parentElement
            parent.classList.toggle('show')
            
            let status = parent.classList.contains('show')

            
            content.children[0].addEventListener('click', () => {
                lds.parentElement.classList.remove('show')
                content.classList.remove('animate__bounceIn')
                content.classList.add('animate__bounceOut')
                lds.parentElement.parentElement.style.display = 'none'
            })
            
            if(!status){
                content.classList.remove('animate__bounceIn')
                content.classList.add('animate__bounceOut')
                lds.parentElement.parentElement.style.display = 'none'
            }else{
                content.style.display = "block"
                content.classList.remove('animate__bounceOut')
                content.classList.add('animate__bounceIn')
            }

        })
    }
}

