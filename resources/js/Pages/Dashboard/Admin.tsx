import Logout from "@/Components/Dashboard/Logout";
import Search from "@/Components/Dashboard/Search";
import Setting from "@/Components/Dashboard/Setting";
import { useState } from "react";
import { BiChevronDown, BiChevronUp } from "react-icons/bi";
import { FaUser } from "react-icons/fa6";
import { GoFileDirectoryFill } from "react-icons/go";
import { IoSettingsSharp } from "react-icons/io5";
import { MdSpaceDashboard } from "react-icons/md";
import { RiTeamFill } from "react-icons/ri";
import Logo from "@/Images/Yhoiki Rev copy.png";
import User from "@/Components/Dashboard/User";

const DashboardAdmin = () => {
    const BgColor2: string = 'hover:bg-color2 hover:text-white rounded-md duration-300 shadow-xl'
    const [SubOn, setSubOn] = useState<string>("home");
    const gantiSubOn = (e: string) => {
        setSubOn(e);
    }
    const [ChevronLogout, ChevronLogoutSaatIni] = useState<boolean>(false);
    const BukaChevronLogout = () => {
        ChevronLogoutSaatIni((buka) => !buka);
    }
    return(
        <div className="bg-gray-200 w-full h-screen max-h-screen text-white flex p-5">
            <div className="bg-gradient-to-b from-color1 to-color2 w-20 h-full rounded-3xl flex flex-col items-center justify-between py-6 border border-color1 text-2xl">
                <div className="group flex items-center duration-300 hover:scale-[1.05]"><img src={Logo} alt="logo" className="w-7"/><p className="absolute left-20 text-sm bg-color1 p-2 rounded-xl shadow-xl hidden group-hover:block">Yhoiki</p></div>
                <div className="flex flex-col space-y-5">
                    <div className={`${BgColor2} ${SubOn === "home" && "bg-color1 text-white scale-[1.10]"} p-2 cursor-pointer text-gray-300 flex items-center group duration-300 hover:scale-[1.05]`} onClick={() => gantiSubOn("home")}><MdSpaceDashboard/><p className="absolute left-20 text-sm bg-color1 p-2 rounded-xl shadow-xl hidden group-hover:block">Dashboard</p></div>
                    <div className={`${BgColor2} ${SubOn === "user" && "bg-color1 text-white scale-[1.10]"} p-2 cursor-pointer text-gray-300 flex items-center group duration-300 hover:scale-[1.05]`} onClick={() => gantiSubOn("user")}><FaUser/><p className="absolute left-20 text-sm bg-color1 p-2 rounded-xl shadow-xl hidden group-hover:block">User</p></div>
                    <div className={`${BgColor2} ${SubOn === "team" && "bg-color1 text-white scale-[1.10]"} p-2 cursor-pointer text-gray-300 flex items-center group duration-300 hover:scale-[1.05]`} onClick={() => gantiSubOn("team")}><RiTeamFill/><p className="absolute left-20 text-sm bg-color1 p-2 rounded-xl shadow-xl hidden group-hover:block">Team</p></div>
                    <div className={`${BgColor2} ${SubOn === "file" && "bg-color1 text-white scale-[1.10]"} p-2 cursor-pointer text-gray-300 flex items-center group duration-300 hover:scale-[1.05]`} onClick={() => gantiSubOn("file")}><GoFileDirectoryFill/><p className="absolute left-20 text-sm bg-color1 p-2 rounded-xl shadow-xl hidden group-hover:block">File</p></div>
                </div>
                <div className={`group flex items-center duration-200 hover:scale-[1.10] ${SubOn === "setting" && "bg-color1 p-2 rounded-xl"}`} onClick={() => gantiSubOn("setting")}><div className="group-hover:rotate-180 duration-200"><IoSettingsSharp/></div><p className="absolute left-20 text-sm bg-color1 p-2 rounded-xl shadow-xl hidden group-hover:block">Setting</p></div>
            </div>
            <div className="w-full h-full ml-5 flex flex-col space-y-5">
                <div className="bg-white w-full h-20 rounded-2xl flex items-center justify-between text-gray-500 p-4">
                    <Search/>
                    <div id="roles"><p className="bg-color1 p-2 text-white rounded-xl">Admin</p></div>
                    <div id="profil" className="flex items-center">
                        <div id="buttonout" className="text-3xl cursor-pointer" onClick={BukaChevronLogout}>{ChevronLogout ? <BiChevronUp/> : <BiChevronDown/>}{ChevronLogout === true && <div className="absolute top-28"><Logout/></div>}</div>
                        <div id="nameadmin"><p>username</p></div>
                        <div id="profil" className="w-14 h-14 bg-gray-200 rounded-full flex items-center justify-center text-2xl ml-4"><FaUser/></div>
                    </div>
                </div>
                <div id="perubahansection" className=" w-full h-full">
                    {SubOn === "user" && <User/>}
                    {SubOn === "setting" && <Setting/>}
                </div>
            </div>
        </div>
    )
}

export default DashboardAdmin;