% input view = 5 & 7
% virtual view = 0
% modify parameter VirtualCameraName
[status,resultStr]= system('ViewSynVC7.exe ../data/kendo/config/VSRS/vsrs_kendo_ori.cfg');
inputWidth = 1024;
inputHeight = 768;

%oriImage = loadYUV('kendo_syn_ori.yuv',inputWidth,inputHeight);
%oriImage = rgb2ycbcr(oriImage);
%oriImage = oriImage(:,:,1);

%VSRS??cfg?O?g????, ???H???n4??cfg????, ?????u??????io?????|???P
vsrsCfgPath = '../data/kendo/config/VSRS/vsrs_kendo_matlab.cfg';
vsrsCfg2Path = '../data/kendo/config/VSRS/vsrs_kendo_matlab2.cfg';
vsrsCfgWMPath = '../data/kendo/config/VSRS/vsrs_kendo_matlab_WMGeneration.cfg';
%load initial data

original_I_L = loadYUV('../data/kendo/kendo_ori_I_1.yuv',inputWidth,inputHeight);
original_I_L_ycbcr = rgb2ycbcr(original_I_L);
original_I_L = original_I_L_ycbcr(:,:,1);

original_I_R = loadYUV('../data/kendo/kendo_ori_I_3.yuv',inputWidth,inputHeight);
original_I_R_ycbcr = rgb2ycbcr(original_I_R);
original_I_R = original_I_R_ycbcr(:,:,1);

original_D_L = loadYUV('../data/kendo/kendo_ori_D_1.yuv',inputWidth,inputHeight);
original_D_L_ycbcr = rgb2ycbcr(original_D_L);
original_D_L = original_D_L_ycbcr(:,:,1);

original_D_R = loadYUV('../data/kendo/kendo_ori_D_3.yuv',inputWidth,inputHeight);
original_D_R_ycbcr = rgb2ycbcr(original_D_R);
original_D_R = original_D_R_ycbcr(:,:,1);


%camera parameters
A_L = [ 2241.25607 ,   0.0 ,   701.5   ;
    0.0             ,   2241.25607   ,   514.5   ;
    0.0             ,   0.0 , 1.0];
R_L = [ 1 , 0 , 0;
    0 , 1 , 0;
    0 , 0 , 1];
A_R = [ 2241.25607 ,   0.0 ,   701.5   ;
    0.0             ,   2241.25607   ,   514.5   ;
    0.0             ,   0.0 , 1.0];
R_R = [ 1 , 0 , 0;
    0 , 1 , 0;
    0 , 0 , 1];
T_L = [ 5 ; 0 ;  0];
T_R = [ 15 ; 0 ; 0];

Z_near = 448.251214;
Z_far = 11206.280350;

A_syn = [ 2241.25607 ,   0.0 ,   701.5   ;
    0.0             ,   2241.25607   ,   514.5   ;
    0.0             ,   0.0 , 1.0];
R_syn = [ 1 , 0 , 0;
    0 , 1 , 0;
    0 , 0 , 1];
T_syn = [ 10 ; 0 ;  0];

%?n????: io???|, baseviewcameranumbers, camara parameter, cfg
% %initial compression
HTMString_I_L = strcat(' --InputFile_0=tmp_I_l.yuv --DepthInputFile_0=../data/kendo/kendo_ori_D_1.yuv  --ReconFile_0=tmp_I_recon_l.yuv --BaseViewCameraNumbers=1 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
HTMString_I_R = strcat(' --InputFile_0=tmp_I_r.yuv --DepthInputFile_0=../data/kendo/kendo_ori_D_3.yuv  --ReconFile_0=tmp_I_recon_r.yuv --BaseViewCameraNumbers=3 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
% HTMString_D_L = strcat(' --InputFile_0=../data/kendo/kendo_ori_D_1.yuv --DepthInputFile_0=../data/kendo/kendo_ori_D_1.yuv  --ReconFile_0=tmp_D_recon_l.yuv --BaseViewCameraNumbers=1 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
% HTMString_D_R = strcat(' --InputFile_0=../data/kendo/kendo_ori_D_3.yuv --DepthInputFile_0=../data/kendo/kendo_ori_D_3.yuv  --ReconFile_0=tmp_D_recon_r.yuv --BaseViewCameraNumbers=3 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');

% second compression
% HTMString2_I_L = strcat(' --InputFile_0=embed_I_l.yuv --DepthInputFile_0=embed_I_l.yuv  --ReconFile_0=embed_I_recon_l.yuv --BaseViewCameraNumbers=1 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
% HTMString2_I_R = strcat(' --InputFile_0=embed_I_r.yuv --DepthInputFile_0=embed_I_r.yuv  --ReconFile_0=embed_I_recon_r.yuv --BaseViewCameraNumbers=3 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
% HTMString2_D_L = strcat(' --InputFile_0=embed_D_l.yuv --DepthInputFile_0=embed_D_l.yuv  --ReconFile_0=embed_D_recon_l.yuv --BaseViewCameraNumbers=1 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
% HTMString2_D_R = strcat(' --InputFile_0=embed_D_r.yuv --DepthInputFile_0=embed_D_r.yuv  --ReconFile_0=embed_D_recon_r.yuv --BaseViewCameraNumbers=3 --CameraParameterFile=../data/kendo/config/HTM/cam_kendo.cfg -c ../data/kendo/config/HTM/HTM_cfg_kendo.cfg');
VSRSString = './ViewSyn vsrs_kendo_tmp.cfg';
VSRSString2 = './ViewSyn vsrs_kendo_tmp2.cfg';
VSRSName = 'kendo_syn_tmp.yuv';
