-优化- 

/O1 最小化空间                                                               /Op[-] 改善浮点数一致性 
/O2 最大化速度                                                                /Os 优选代码空间 
/Oa 假设没有别名                                                           /Ot 优选代码速度 
/Ob<n> 内联展开(默认 n=0)                                            /Ow 假设交叉函数别名 
/Od 禁用优化(默认值)                                                       /Ox 最大化选项。(/Ogityb2 /Gs) 
/Og 启用全局优化                                                            /Oy[-] 启用框架指针省略 
/Oi 启用内部函数 

-代码生成- 

/G3 为 80386 进行优化                                                           /Gh 启用 _penter 函数调用 
/G4 为 80486 进行优化                                                            /GH 启用 _pexit 函数调用 
/G5 为 Pentium 进行优化                                                          /GR[-] 启用 C++ RTTI 
/G6 对 PPro、P-II、P-III 进行优化                                            /GX[-] 启用 C++ EH (与 /EHsc 相同) 
/G7 对 Pentium 4 或 Athlon 进行优化                                      /EHs 启用 C++ EH (没有 SEH 异常) 
/GB 为混合模型进行优化(默认)                                                 /EHa 启用 C++ EH(w/ SEH 异常) 
/Gd __cdecl 调用约定                                                              /EHc extern "C" 默认为 nothrow 
/Gr __fastcall 调用约定                                                            /GT 生成纤维安全   TLS 访问 
/Gz __stdcall 调用约定                                                               /Gm[-] 启用最小重新生成 
/GA 为 Windows 应用程序进行优化                                        /GL[-] 启用链接时代码生成 
/Gf 启用字符串池                                                                     /QIfdiv[-] 启用 Pentium FDIV 修复 
/GF 启用只读字符串池                                                             /QI0f[-] 启用 Pentium 0x0f 修复 
/Gy 分隔链接器函数                                                                /QIfist[-] 使用 FIST 而不是 ftol() 
/GZ 启用堆栈检查(/RTCs)                                                        /RTC1 启用快速检查(/RTCsu) 
/Ge 对所有函数强制堆栈检查                                                   /RTCc 转换为较小的类型检查 
/Gs[num]   控制堆栈检查调用                                                    /RTCs 堆栈帧运行时检查 
/GS 启用安全检查                                                                    /RTCu 未初始化的本地用法检查 
/clr[:noAssembly] 为公共语言运行库编译 
           noAssembly - 不产生程序集 
/arch:<SSE|SSE2> CPU 结构的最低要求，以下内容之一: 
                        SSE - 启用支持 SSE 的 CPU 可用的指令 
                        SSE2 - 启用支持 SSE2 的 CPU 可用的指令 

-输出文件- 

/Fa[file] 命名程序集列表文件                                      /Fo<file> 命名对象文件 
/FA[sc] 配置程序集列表                                                /Fp<file> 命名预编译头文件 
/Fd[file] 命名 .PDB 文件                                              /Fr[file] 命名源浏览器文件 
/Fe<file> 命名可执行文件                                          /FR[file] 命名扩展 .SBR 文件 
/Fm[file] 命名映射文件 

-预处理器- 

/AI<dir> 添加到程序集搜索路径                                /Fx 将插入的代码合并到文件 
/FU<file> 强制使用程序集/模块                                   /FI<file> 命名强制包含文件 
/C 不抽出注释                                                            /U<name> 移除预定义宏 
/D<name>{=|#}<text> 定义宏                                    /u 移除所有预定义宏 
/E 预处理到 stdout                                                   /I<dir> 添加到包含搜索路径 
/EP 预处理到 stdout，没有 #line                             /X 忽略“标准位置” 
/P 预处理到文件 

-语言- 

/Zi 启用调试信息                                                     /Ze 启用扩展(默认) 
/ZI 启用“编辑并继续”调试信息                              /Zl 省略 .OBJ 中的默认库名 
/Z7 启用旧式调试信息                                              /Zg 生成函数原型 
/Zd 仅有行号调试信息                                              /Zs 只进行语法检查 
/Zp[n] 在 n 字节边界上包装结构                             /vd{0|1} 禁用/启用 vtordisp 
/Za 禁用扩展(暗指 /Op)                                             /vm<x> 指向成员的指针类型 
/Zc:arg1[,arg2] C++ 语言一致性，这里的参数可以是: 
                      forScope - 对范围规则强制使用标准 C++ 
                      wchar_t - wchar_t 是本机类型，不是 typedef 

- 杂项 - 

@<file> 选项响应文件                                             /wo<n> 发出一次警告 n 
/?, /help 打印此帮助消息                                          /w<l><n> 为 n 设置警告等级 1-4 
/c 只编译，不链接                                                  /W<n> 设置警告等级(默认 n=1) 
/H<num> 最大外部名称长度                                    /Wall 启用所有警告 
/J 默认 char 类型是 unsigned                               /Wp64 启用 64 位端口定位警告 
/nologo 取消显示版权消息                                  /WX 将警告视为错误 
/showIncludes 显示包含文件名                            /WL 启用单行诊断 
/Tc<source file> 将文件编译为 .c                          /Yc[file] 创建 .PCH 文件 
/Tp<source file> 将文件编译为 .cpp                   /Yd 将调试信息放在每个 .OBJ 中 
/TC 将所有文件编译为 .c                                       /Yl[sym] 为调试库插入 .PCH 引用 
/TP 将所有文件编译为 .cpp                                  /Yu[file] 使用 .PCH 文件 
/V<string> 设置版本字符串                                  /YX[file] 自动 .PCH 
/w 禁用所有警告                                                    /Y- 禁用所有 PCH 选项 
/wd<n> 禁用警告 n                                               /Zm<n> 最大内存分配(默认为 %) 
/we<n> 将警告 n 视为错误 

-链接- 

/MD 与 MSVCRT.LIB 链接                                   /MDd 与 MSVCRTD.LIB 调试库链接 
/ML 与 LIBC.LIB 链接                                        /MLd 与 LIBCD.LIB 调试库链接 
/MT 与 LIBCMT.LIB 链接                                     /MTd 与 LIBCMTD.LIB 调试库链接 
/LD 创建 .DLL                                                       /F<num> 设置堆栈大小 
/LDd 创建 .DLL 调试库                                       /link [链接器选项和库]  
 
关于链接时参数的说明：
VC项目属性→配置属性→C/C++→代码生成→运行时库 可以采用的方式有：多线程(/MT)、多线程调试(/MTd)、多线程DLL(/MD)、多线程调试DLL(/MDd)、单线程(/ML)、单线程调试(/MLd)。
Reusable Library
Switch
Library
Macro(s) Defined
Single Threaded
/ML
LIBC
(none)
Static MultiThread
/MT
LIBCMT
_MT
Dynamic Link (DLL)
/MD
MSVCRT
_MT and _DLL
Debug Single Threaded
/MLd
LIBCD
_DEBUG
Debug Static MultiThread
/MTd
LIBCMTD
_DEBUG and _MT
Debug Dynamic Link (DLL)
/MDd
MSVCRTD
_DEBUG, _MT, and _DLL
 
    其中以小写“d”结尾的选项表示的DEBUG版本的，没有“d”的为RELEASE版本。大型项目中必须要求所有组件和第三方库的运行时库是统一的，否则将会出现LNK2005井喷。
    单线程运行时库选项/ML和/MLd在VS2003以后就被废了。
    /MT和/MTd表示采用多线程CRT库的静态lib版本。该选项会在编译时将运行时库以静态lib的形式完全嵌入。该选项生成的可执行文件运行时不需要运行时库dll的参加，会获得轻微的性能提升，但最终生成的二进制代码因链入庞大的运行时库实现而变得非常臃肿。当某项目以静态链接库的形式嵌入到多个项目，则可能造成运行时库的内存管理有多份，最终将导致致命的“Invalid Address specified to RtlValidateHeap”问题。另外托管C++和CLI中不再支持/MT和/MTd选项。
    /MD和/MDd表示采用多线程CRT库的动态dll版本，会使应用程序使用运行时库特定版本的多线程DLL。链接时将按照传统VC链接dll的方式将运行时库MSVCRxx.DLL的导入库MSVCRT.lib链接，在运行时要求安装了相应版本的VC运行时库可再发行组件包（当然把这些运行时库dll放在应用程序目录下也是可以的）。 因/MD和/MDd方式不会将运行时库链接到可执行文件内部，可有效减少可执行文件尺寸。当多项目以MD方式运作时，其内部会采用同一个堆，内存管理将被简化，跨模块内存管理问题也能得到缓解。
    结论：/MD和/MDd将是潮流所趋，/ML和/MLd方式请及时放弃，/MT和/MTd在非必要时最好也不要采用了。