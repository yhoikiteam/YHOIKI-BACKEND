import Search from "@/Components/Dashboard/Search";
import { useState } from "react";

const Setting = () => {
    interface SubSettNama {
        nama: string;
    }
    const SubSettNama: SubSettNama[] = [
        {nama: "Layanan"},
        {nama: "Testimony"},
        {nama: "Contact"},
        {nama: "FAQ"},
    ]
    const [SubSett, SubSettIni] = useState<string>("Layanan");
    const SetSubSett = (e: string) => {
        SubSettIni(e);
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
                {SubSett === "Layanan" && 
                <div className="flex flex-col p-5 space-y-5">
                    <div className="flex justify-between bg-white p-4 rounded-xl"><div><input type="number" name="search" id="id" placeholder="0" className="text-gray-500 outline-none border-none w-24 rounded-xl focus:ring-color1 bg-slate-200 p-2"/></div><Search/></div>
                    {/* Disini Data Layanan Akan Di Muat */}
                    <div className="bg-white rounded-xl w-full h-20">

                    </div>
                </div>}
            </div>
        </div>
    )
}

export default Setting;