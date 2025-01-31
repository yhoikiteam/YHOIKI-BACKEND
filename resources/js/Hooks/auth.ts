import apiClient from "@/Lib/axios";

export const loginUser = async(data: {email: string; password: string}) => {
    try {
        const response = await apiClient.post('/login', data);
        window.location.href = '/home'
        return (response.data);
    } catch (error: any) {
        console.log('Eror Abangkuuu: ', error.response.data.message);
        return(error.response.data.message);
    }
};