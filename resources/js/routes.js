import Home from './components/Home'
import Login from './components/Login'
import Post from './components/Post'
import Register from './components/Register'

const routes = [
    {path:'/', component: Home},
    {path:'/login', component: Login},
    {path:'/posts', component: Post},
    {path:'/register', component: Register}
]

export default routes