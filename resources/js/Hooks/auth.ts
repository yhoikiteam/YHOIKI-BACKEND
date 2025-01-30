import apiClient from "@/Lib/axios";

export const loginUser = async(data: {email: string; password: string}) => {
    try {
        const response = await apiClient.post('/login', data);
        if( response.data.status === 'success') {
            window.location.href="/dashboard";
            return (response.data);
        }
        return (response.data);
    } catch (error: any) {
        console.log('Eror Abangkuuu: ', error.response.data.message);
        return(error.response.data.message);
    }
};