import { useForm } from "@inertiajs/react"

const DashboardUser = () => {
    const { post } = useForm();
    const untukLogout = () => {
        post("/logout")
    }
    return (
        <div className="w-full h-screen bg-white flex flex-col justify-center items-center space-y-5">
            <div className="w-3/5 bg-white border shadow-2xl rounded-2xl flex flex-col items-center space-y-10 p-5 text-center">
                <div className="text-4xl w-full flex justify-end pr-2">
                    <button
                        type="button"
                        className="text-gray-600 absolute"
                        onClick={() => window.location.href="/"}
                    >
                        &times;
                    </button>
                </div>
                <a href="/" id="logo" className="flex space-x-3 items-center p-5">
                    <img
                        className="w-12"
                        src="https://i.ibb.co.com/0DhSzYN/Yhoiki.png"
                        alt="logo"
                    />
                <h1 className="text-gray-700 font-bold text-4xl">Yhoiki</h1>
                </a>
                <div className="space-y-5">
                <h1 className="text-5xl font-bold text-center text-gray-700">
                    <span className="bg-gradient-to-r from-color1 to-color2 bg-clip-text text-transparent">Welcome</span> To Api <span className="bg-gradient-to-r from-color1 to-color2 bg-clip-text text-transparent">Yhoiki</span> Team
                </h1>
                <p className="text-center text-gray-600 px-10">Website Penyedia Layanan Jasa, Freelancer, Course, Program Kerja Sama, Dan Juga Komunitas Programer Indonesia, Ciptakan Dunia Digital Yang Baik!</p>
                </div>
                <div className="w-full h-24 bg-gray-200 border border-gray-300 rounded-2xl text-white flex justify-center items-center space-x-5 text-xl">
                    <h1 className="text-red-500">Maaf Anda Tidak Memiliki Akses Kesini</h1>
                    <button onClick={untukLogout} className="bg-gradient-to-r from-red-500 to-red-800 p-3 rounded-xl">Logout</button>
                </div>
            </div>
        </div>
    )
}

export default DashboardUser;