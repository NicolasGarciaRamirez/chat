export default {
    imgWidth : '', 
    imgHeigth : '', 
    dataImage : '',
// var imgWidth, imgHeigth, dataImage

    getImage(canvas, imagen){
        console.log(canvas.getContext('2d'))
        console.log(imagen)
        var ctx = canvas.getContext('2d')
        
        if (canvas.getContext('2d')) {
            var img = new Image()
            img.src = imagen
            img.onload = function(){
                this.imgWidth = this.width;
                this.imgHeigth = 400;
                canvas.width = this.imgWidth;
                canvas.height = this.imgHeigth;
                ctx.drawImage(this, 0,0, this.imgWidth, this.imgHeigth)
            };
            console.log(img)

            return img;
        }
    }
}
