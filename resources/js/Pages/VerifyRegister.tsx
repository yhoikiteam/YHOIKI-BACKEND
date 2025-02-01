interface userInfo {
    name: string;
    email: string;
    token: string;
}

const VerifyRegister = ({name, email, token}: userInfo) => {
    return (
        <div className="p-5">
            <div className="bg-white w-full shadow-xl border p-5 rounded-2xl flex flex-col justify-center text-center">
                <div className="w-full flex flex-col items-center rounded-xl px-5 py-10">
                    <div id="logo" className="flex space-x-5 items-center mb-10">
                            <img
                                className="w-12"
                                src="https://i.ibb.co.com/0DhSzYN/Yhoiki.png"
                                alt="logo"
                            />
                        <h1 className="text-gray-700 font-bold text-5xl">Yhoiki</h1>
                    </div>
                    <div className="space-y-5">
                <h1 className="text-5xl font-bold text-center text-gray-700">
                    <span className="bg-gradient-to-r from-color1 to-color2 bg-clip-text text-transparent">Welcome</span> To Website <span className="bg-gradient-to-r from-color1 to-color2 bg-clip-text text-transparent">Yhoiki</span> Team
                </h1>
                <p className="text-center text-gray-600 px-10">Website Penyedia Layanan Jasa, Freelancer, Course, Program Kerja Sama, Dan Juga Komunitas Programer Indonesia, Ciptakan Dunia Digital Yang Baik!</p>
                </div>
                </div>
                <div className="bg-gray-200 rounded-xl w-full p-16 flex flex-col items-center space-y-10">
                    <h1 className="text-4xl font-bold text-center text-gray-700">
                        <span className="bg-gradient-to-r from-color1 to-color2 bg-clip-text text-transparent">Verification</span> Email
                    </h1>
                    <p className="text-gray-700">Halo <span className="font-bold">Resta{name}</span> Dengan Email <span className="font-bold">restanugroho21@gmail.com{email}</span> Selesaikan Pendaftaranmu Di Website Yhoiki Team, Kode Berlaku 5 Menit Setelah Di Kirim, Jangan Memberikan Kode Ini Kesiapapun, Waspada Penipuan!, Kode Ada di Bawah Ini</p>
                    <h1 className="bg-gray-300 border p-3 rounded-xl w-24 text-xl text-gray-700 font-bold">723191{token}</h1>
                    <a href="/" className="bg-gradient-to-r from-color1 to-color2 text-white text-xl font-bold p-3 rounded-xl">Verifikasi Sekarang</a>
                    <p className="text-color1">Bantuan: yhoikiteam@gmail.com </p>
                    <p className="text-gray-600">&copy; <span id="year"></span> Yhoiki Team. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    )
}

export default VerifyRegister;