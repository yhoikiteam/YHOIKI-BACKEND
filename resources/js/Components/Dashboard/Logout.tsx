import { FiPower } from "react-icons/fi"
import { useForm } from "@inertiajs/react"

const Logout = () => {
    const { post } = useForm();
    const untukLogout = () => {
        post("/logout")
    }
    return(
        <button onClick={untukLogout} className="flex justify-center items-center space-x-2 bg-white p-2 rounded-xl text-sm cursor-pointer hover:text-red-500 duration-300">
            <FiPower/>
            <p>Logout</p>
        </button>
    )
}

export default Logout