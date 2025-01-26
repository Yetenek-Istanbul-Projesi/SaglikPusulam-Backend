import axios from 'axios';

// Axios instance oluşturma
const apiService = axios.create({
    baseURL: '/api/v1', // API base URL
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

// Request interceptor - token ekleme
apiService.interceptors.request.use(config => {
    const token = localStorage.getItem('token'); // Token'ı localStorage'dan al
    if (token) {
        config.headers.Authorization = `Bearer ${token}`; // Token'ı header'a ekle
    }
    return config;
});

// Response interceptor - hata yönetimi
apiService.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            // Token geçersizse veya süresi dolmuşsa, kullanıcıyı çıkış yaptır
            localStorage.removeItem('token');
            window.location.href = '/login'; // Giriş sayfasına yönlendir
        }
        return Promise.reject(error);
    }
);

export default apiService;


// Kullanıcı girişi
export const login = async (credentials) => {
    const response = await apiService.post('/auth/login', credentials);
    return response.data;
};

// Kullanıcı kaydı
export const register = async (userData) => {
    const response = await apiService.post('/auth/register', userData);
    return response.data;
};

// Profil güncelleme
export const updateProfile = async (profileData) => {
    const response = await apiService.put('/profile/update', profileData);
    return response.data;
};

// Diğer API istekleri için benzer fonksiyonlar