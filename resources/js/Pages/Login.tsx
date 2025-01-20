import { useForm } from "@inertiajs/react";
import { useState } from "react";
import { FiEye, FiEyeOff } from "react-icons/fi";

interface Errors {
  email?: string;
  password?: string;
}

const Login = () => {
  const { data, setData, post, errors, processing } = useForm<{
    email: string;
    password: string;
  }>({
    email: "",
    password: "",
  });

  const [passwordVisible, setPasswordVisible] = useState<boolean>(false);

  const togglePasswordVisibility = () => {
    setPasswordVisible((prev) => !prev);
  };

  const handleSubmit = (event: React.FormEvent) => {
    event.preventDefault();

    post("/api/login", {
      onSuccess: () => {
        window.location.href="/dashboard";
      },
      onError: (error: Errors) => {
        
      },
    });
  };

  return (
    <div className="w-full h-screen bg-white backdrop-blur-sm flex items-center justify-center">
      <form
        onSubmit={handleSubmit}
        className="bg-white w-3/5 h-96 rounded-3xl border border-gray-300 flex shadow-xl relative"
      >
        {/* Logo X di pojok kanan atas */}
        <div className="text-4xl">
          <button
            type="button"
            className="absolute top-4 right-4 text-gray-600"
            onClick={() => window.location.href="/"}
          >
            &times;
          </button>
        </div>

        {/* Bagian Gambar */}
        <div className="w-1/2 h-full overflow-hidden flex justify-center items-center">
          <a href="/" id="logo" className="flex space-x-3 items-center absolute p-5">
            <img
              className="w-7"
              src="https://i.ibb.co.com/0DhSzYN/Yhoiki.png"
              alt="logo"
            />
            <h1 className="text-gray-700 font-bold text-xl">Yhoiki</h1>
          </a>
        </div>

        {/* Form Login */}
        <div className="w-1/2 flex flex-col space-y-4 p-8 justify-center items-center text-gray-600">
          <h1 className="text-2xl font-bold text-gray-600">Login</h1>

          {/* Input Email */}
          <input
            type="email"
            name="email"
            value={data.email}
            onChange={(e) => setData("email", e.target.value)}
            placeholder="Email"
            className="bg-gray-200 rounded-full px-6 py-2 border border-gray-300 hover:bg-gray-300 outline-color1 duration-300 w-full"
          />
          {errors.email && (
            <p className="text-red-500 text-xs">{errors.email}</p>
          )}

          {/* Input Password */}
          <div className="w-full relative">
            <input
              type={passwordVisible ? "text" : "password"}
              placeholder="Password"
              name="password"
              value={data.password}
              onChange={(e) => setData("password", e.target.value)}
              className="bg-gray-200 rounded-full px-6 py-2 border border-gray-300 hover:bg-gray-300 outline-color1 duration-300 w-full"
            />
            <button
              type="button"
              className="absolute right-4 top-1/2 transform -translate-y-1/2"
              onClick={togglePasswordVisibility}
            >
              {passwordVisible ? (
                <FiEyeOff className="text-gray-400" size={20} />
              ) : (
                <FiEye className="text-gray-400" size={20} />
              )}
            </button>
          </div>
          {errors.password && (
            <p className="text-red-500 text-xs">{errors.password}</p>
          )}

          <div className="w-full flex justify-between px-2">
            <button className="cursor-pointer text-color1 text-sm px-2 hover:text-color2 duration-300">
              Forgot Password?
            </button>
            <button className="cursor-pointer text-color1 text-sm px-2 hover:text-color2 duration-300">
              Register
            </button>
          </div>

          <button
            type="submit"
            disabled={processing}
            className="bg-gradient-to-r from-color1 to-color2 text-white w-full rounded-full p-2 hover:from-color2 hover:to-color2 duration-300"
          >
            {processing ? "Logging in..." : "Login"}
          </button>
        </div>
      </form>
    </div>
  );
};

export default Login;
