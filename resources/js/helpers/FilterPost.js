export default{
    state:{
        genres: null,
        categories: null,
        deleted: false
    },
    initialize(){
        this.state.genres = sessionStorage.getItem('genres')
        this.state.categories = sessionStorage.getItem('categories')
    },
    setGenres(genres){
        sessionStorage.setItem('genres', JSON.stringify(genres))
        this.initialize()
        if(genres.length < 1) {
            this.deleteItemGenres()
            this.genres = null
        }
    },
    setCategories(categories){
        sessionStorage.setItem('categories', JSON.stringify(categories))
        this.initialize()
        if(categories.length < 1) {
            this.deleteItemCategories()
            this.categories = null
        }
    },
    removeOrAddCategories(category){
        const categories = (this.state.categories == null) ? [] : JSON.parse(this.state.categories);
        if(categories.includes(category)){
            _.remove(categories, function(n) { return n === category });
            this.deleted = true
        }else{
            categories.push(category)
            this.deleted = false
        }
        this.setCategories(categories)
    },
    removeOrAddGenres(genre){
        const genres = (this.state.genres == null) ? [] : JSON.parse(this.state.genres);
        if(genres.includes(genre)){
            _.remove(genres, function(n) { return n === genre });
            this.deleted = true
        }else{
            genres.push(genre)
            this.deleted = false
        }
        this.setGenres(genres)
    },
    jsonParseAttributes(){
        return {
            genres: JSON.parse(this.state.genres),
            categories: JSON.parse(this.state.categories)
        }
    },
    deleteItemGenres(){
        sessionStorage.removeItem('genres')
    },
    deleteItemCategories(){
        sessionStorage.removeItem('categories')
    }
}
