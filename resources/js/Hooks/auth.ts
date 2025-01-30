import apiClient from "@/Lib/axios";

export const loginUser = async(data: {email: string; password: string}) => {
    try {
        const response = await apiClient.post('/login', data);
        if( response.data.status === 'success') {
            const role = response.data.user.role;
            if( role === 'user') {
                window.location.href = '/dashboard/user';
                return (response.data);
            } else if( role === 'yhoiki') {
                window.location.href = '/dashboard/yhoiki';
                return (response.data);
            } else if( role === 'admin') {
                window.location.href = '/dashboard/admin';
                return (response.data);
            }
        } else {
            return (response.data);
        }
    } catch (error: any) {
        console.log('Eror Abangkuuu: ', error.response.data.message);
        return(error.response.data.message);
    }
};