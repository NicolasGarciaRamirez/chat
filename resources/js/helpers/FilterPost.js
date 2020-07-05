export default{
    state:{
        genres: [],
        categories: [],
    },
    initialize(){
        this.state.genres = localStorage.getItem('genres')
        this.state.categories = localStorage.getItem('categories')
    },
    setGenres(genres){
        localStorage.setItem('genres', JSON.stringify(genres))
        this.initialize()
    },
    setCategories(categories){
        localStorage.setItem('categories', JSON.stringify(categories))
        this.initialize()
    },
    removeOrAddCategories(category){
        const categories = (this.state.categories == null) ? [] : JSON.parse(this.state.categories);
        if(categories.includes(category)){
            _.remove(categories, function(n) { return n == category });
        }else{
            categories.push(category)
        }
        this.setCategories(categories)
    },
    removeOrAddGenres(genre){
        const genres = (this.state.genres == null) ? [] : JSON.parse(this.state.genres);
        if(genres.includes(genre)){
            _.remove(genres, function(n) { return n == genre });
        }else{
            genres.push(genre)
        }
        this.setGenres(genres)
    }
}
