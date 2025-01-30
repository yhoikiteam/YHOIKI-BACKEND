import Logout from "@/Components/Dashboard/Logout"

const dashboardUser = () => {
    return (
        <div className="w-full h-screen flex flex-col justify-center items-center text-3xl">
            <h1>Di Dashboard User</h1>
            <Logout/>
        </div>
    )
}

export default dashboardUser;