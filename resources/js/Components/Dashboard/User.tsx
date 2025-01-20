import Search from "@/Components/Dashboard/Search";
import { useState, useEffect } from "react";
import { DiVim } from "react-icons/di";
import { FaUser } from "react-icons/fa6";

const User = () => {
    interface SubSettNama {
        nama: string;
    }
    const SubSettNama: SubSettNama[] = [
        {nama: "User"},
        {nama: "Member Yhoiki"},
        {nama: "Admin"},
    ]
    const [SubSett, SubSettIni] = useState<string>("User");
    const SetSubSett = (e: string) => {
        SubSettIni(e);
    }

    interface user {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        created_at: string;
        updated_at: string;
      };      
    const [userData, userDataSaatini] = useState<user[]>([]);
    useEffect(() => {
        const AmbilUserDariDB = async() => {
            try {
                const response = await fetch("/userdata");
                const result: user[] = await response.json();
                userDataSaatini(result);
            } catch (error) {
                console.log("Error Abangku:", error);
            }
        };
        AmbilUserDariDB();
    }, []);
    const [EditUser, EditUserSaatini] = useState<number>(0);
    const EditMode = (e: number) => {

    }
    return(
        <div className="w-full h-full flex flex-col justify-between space-y-5">
            <div className="bg-white w-full h-16 rounded-2xl text-gray-500 flex items-center px-4 py-4">
                <ul className="flex space-x-10">
                    {SubSettNama.map((isinya, index) => (
                        <li key={index} className={`${SubSett === isinya.nama && "bg-gray-200"} p-2 rounded-xl hover:bg-gray-200 duration-300 cursor-pointer`} onClick={() => SetSubSett(isinya.nama)}>
                            {isinya.nama}
                        </li>
                    ))}
                </ul>
            </div>
            <div className="bg-gray-300 rounded-2xl w-full h-full">
                {SubSett === "User" && 
                <div className="flex flex-col p-5 space-y-5 h-96 w-full overflow-hidden overflow-y-auto rounded-xl">
                    <div className="flex justify-between bg-white p-4 rounded-xl"><div><input type="number" name="search" id="id" placeholder="ID" className="text-gray-500 outline-none border-none w-16 rounded-xl focus:ring-color1 bg-slate-200 p-2 flex"/></div><Search/></div>
                    {/* Disini Data User Akan Di Muat Coyhh */}
                    {userData.map((users) => (
                    <div key={users.id} className={`bg-white rounded-xl ${EditUser == users.id && 'border-2 border-color1'}`}>
                        { EditUser === users.id &&
                        <div className="w-full min-h-16 flex items-center justify-between text-gray-500 px-4">
                            <h1 className="bg-gray-200 w-16 py-2 rounded-xl flex justify-center">ID</h1>
                            <div id="profil" className="w-10 h-10 bg-gray-300 rounded-xl flex items-center justify-center">PP</div>
                            <h1 id="username" className="bg-gray-200 w-40 px-3 py-2 rounded-xl flex justify-center overflow-hidden outline-color1">Username</h1>
                            <h1 id="email" className="bg-gray-200 w-52 px-3 py-2 rounded-xl flex justify-center overflow-hidden outline-color1">EMAIL</h1>
                            <h1 className="bg-color1 w-24 py-2 rounded-xl flex justify-center text-white">STATUS</h1>
                            <h1 id="password" className="bg-gray-200 w-52 px-3 py-2 rounded-xl flex justify-center overflow-hidden outline-color1">PASSWORD</h1>
                            <h1 className="w-24 py-2 rounded-xl flex justify-center text-white cursor-pointer"></h1>
                            <h1 onClick={() => EditUserSaatini(0)} className="bg-red-400 w-24 py-2 rounded-xl flex justify-center text-white cursor-pointer">Batal</h1>
                        </div>}
                        <div className="w-full min-h-16 flex items-center justify-between text-gray-500 px-4">
                            <h1 className="bg-gray-200 w-16 py-2 rounded-xl flex justify-center">{users.id}.</h1>
                            <div id="profil" className="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-2xl"><FaUser/></div>
                            <input id="username" type="text" defaultValue={users.name} className="bg-gray-200 w-40 px-3 py-2 rounded-xl flex justify-center overflow-hidden outline-color1"></input>
                            <input id="email" type="text" defaultValue={users.email} className="bg-gray-200 w-52 px-3 py-2 rounded-xl flex justify-center overflow-hidden outline-color1"></input>
                            <h1 className={`${users.email_verified_at === null ? 'bg-red-400' : 'bg-color1'} w-24 py-2 rounded-xl flex justify-center text-white`}>{users.email_verified_at === null ? 'Unverifed' : 'Verifed'}</h1>
                            <input id="password" type={EditUser === users.id ? "text" : "password"} defaultValue="RestaCoyBro12345" className="bg-gray-200 w-52 px-3 py-2 rounded-xl flex justify-center overflow-hidden outline-color1"></input>
                            <h1 className="bg-red-400 w-24 py-2 rounded-xl flex justify-center text-white cursor-pointer">Hapus</h1>
                            { EditUser === users.id ?
                            <h1 className="bg-color1 w-24 py-2 rounded-xl flex justify-center text-white cursor-pointer">Simpan</h1> :
                            <h1 onClick={() => EditUserSaatini(users.id)} className="bg-yellow-500 w-24 py-2 rounded-xl flex justify-center text-white cursor-pointer">Edit</h1>}
                        </div>
                    </div>))}
                </div>}
            </div>
        </div>
    )
}

export default User;