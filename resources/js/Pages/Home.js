import React from 'react'
import ReactDOM from 'react-dom'
function Home() {
    return (
        <div>
            
        </div>
    )
}

export default Home

if (document.getElementById('home')) {
    ReactDOM.render(<Home/>, document.getElementById('home'))
}