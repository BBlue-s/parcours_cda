import { useState } from "react";

export function App(){
    // J'ai mes données
    const products = [
        {name : "Lenovo thinkpad T440", price:2300, stock:20,img : "http://unsplash.it/100/100"},
        {name : "Dell latitude", price:1580, stock :30, img : "http://unsplash.it/100/100" },
        {name : "Alienware", price:700, stock :15, img : "http://unsplash.it/100/100"},
        {name : "Azus", price:100, stock:20, img : "http://unsplash.it/100/100"}
    ];

    // Je crée un state maxPrice, qui va définir les produits affichés
    const [maxPrice,setMaxPrice] = useState(800);

    // Je filtre les produits
    const filteredProducts = products.filter((product)=>{
        return product.price < maxPrice;
    });
    
    // Je transforme les produits filtrés en div
    const productsBalises = filteredProducts.map( (product,i) => {
        return (
            <div key={i} style={{border:"solid black 1px"}}>
                <p> {product.name} </p>
                <p> {product.price} €</p>
                <p> stock:{product.stock} </p>
                <img src={product.img} alt="" />
            </div>
        )
    } );

    // Quand la range change,
    // maxPrice prend sa valeur (input)
    function updateMaxPrice(event){
        const value = event.target.value;
        setMaxPrice(value);
    }

    return (
        <div>
            <label>
                {maxPrice}€
                <input type="range" max="5000" defaultValue={1000} onInput={updateMaxPrice}/>
            </label>
            {productsBalises}
        </div>
    )
}