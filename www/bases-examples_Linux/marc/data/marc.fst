001 0 "CN_"v1 
008 0 'FE_'v8*7.4 
020 0 mpu,(|IS_|v20^a,|IS_|v22^a,'%'/) 
050 0 mpu,"ST_"v50^a,"."v50^b,"."v50^c,"."v50^d,"."v50^e / v50^a,"."v50^b,"."v50^c,"."v50^d,"."v50^e 
050 0 mpu,v50^a,"."v50^b,"."v50^c,"."v50^d,"."v50^e / v50^a,"."v50^b,"."v50^c,"."v50^d,"."v50^e 
050 4 mpu,v50^a,"."v50^b,"."v50^c,"."v50^d,"."v50^e / v50^a,"."v50^b,"."v50^c,"."v50^d,"."v50^e 
082 0 mpu,(|ST_|v82^a|%|/) 
090 0 mpu,(|CH_|v90^a,|/|v90^b,|/|v90^c,|/|v90^d|%|/) 
100 0 mpu,(v100^a|%|/)/(v600^a|%|/)/(v700^a|%|/)/ 
100 0 mpu,(|AU_|v100^a|%|/) 
100 4 mpu,(v100^a|%|/)/(v600^a|%|/)(v700^a|%|/) 
100 5 '/CR_/', mpu, (v100^a/)/(v700^a) 
110 0 mpu,(v110^a|%|/)/(v610^a|%|/)/(v710^a|%|/)/ 
110 0 mpu,(|AI_|v110^a|%|/) 
110 4 mpu,(v110^a|%|/)/(v610^a|%|/)(v710^a|%|/) 
111 0 mpu,(v111^a|%|/) 
111 0 mpu,(|CF_|v111^a|%|/) 
111 4 mpu,(v111^a|%|/) 
240 0 mpu,(|TI_|v240^a|%|/)/ 
242 0 mpu,(|TI_|v242^a|%|/)
245 0 mpl,(|TI_|v245^a, v245^b|%|/)
245 0 mpu,('|TW_|'v245^a|%|/)
245 4 mpu,(v240^a/)/(v242^a/)/(v245^a/)/(v773^t/)/(v740^a/) 
245 8 mpu,'|TT_|'(v245^a|%|/)
245 8 mpu,'|TW_|',(v240^a|%|/)/(v242^a|%|/)/(v245^a|%|/)/(v773^t|%|/)/(v740^a|%|/) 
245 8 mpu,'|TX_|',(v240^a|%|/)/(v242^a|%|/)/(v245^a|%|/)/(v773^t|%|/)/(v740^a|%|/) 
260 0 mpu,(v260^a|%|/) 
260 0 mpu,(|DA_|v260^c|%|/) 
260 0 mpu,(|ED_|v260^b|%|/)/ 
260 0 mpu,(|PA_|v260^a|%|/), 
260 4 mpu,(v260^a|%|/) 
260 4 mpu,(v260^b/) 
260 8 mpu,'/TW_/' (v260^a|%|/), 
490 0 mpu, (v490^a|%|/), 
490 0 mpu, (|MS_|v490^a|%|/), 
490 4 mpu,(v490^a|%|/) 
500 8 mpu,'|AB_|'(v500^a|%|/)/ 
600 0 mpu,(|AU_|v600^a|%|/) 
610 0 mpu,(|AI_|v610^a|%|/) 
611 0 mpu,(v611^a|%|/) 
611 0 mpu,(|CF_|v611^a|%|/) 
611 4 mpu,(v611^a|%|/) 
650 1 mpu,(v650*4|%|/) 
650 4 mpu,(v650*4|%|/) 
650 5 mdu,'/MA_/' (v650*4|%|/), 
650 5 mdu,'/SU_/' (v650*4|%|/), 
651 1 mpu,(v651*4|%|/) 
651 4 mpu,(v651*4|%|/) 
651 5 mpu,'/DG_/' (v651*4|%|/), 
700 0 mpu,(|AU_|v700^a|%|/) 
710 0 mpu,(|AI_|v710^a|%|/) 
711 0 mpu,(v711^a|%|/) 
711 0 mpu,(|CF_|v711^a|%|/) 
711 4 mpu,(v711^a|%|/) 
740 0 mpu,(|TI_|v740^a|%|/) 
773 0 mpu,(|TI_|v773^t|%|/)/ 
900 0 (|NI=|v900^n/) 
901 0 mpu,(if iocc<100 then |UB_|v900^o|%|/ else break fi)/(if iocc<100 then v900^o|%|/ else break fi) 
902 0 mpu,(if iocc<100 then |PR_|v900^r|%|/ else break fi) 
903 0 v1 
905 0 (v700^a/) 
905 0 v100^a 
905 0 v110^a 
905 0 v111^a 
906 0 mpu,(if V3006='a' then 'BK' fi)/(if V3006='s' then 'SE' fi)
945 0 v245^a 
960 0 v260^c 
966 0 mpu,(|TPR_|v3006|%|/)/
998 0 mpu,'|TW_|'(v111^a|%|/) 
998 0 mpu,'|TW_|'(v611^a|%|/) 
998 0 mpu,'|TW_|'(v711^a|%|/) 
998 8 mdu,'/TW_/' (v650*4|%|/), 
998 8 mpu,'/TW_/' (v490^a|%|/), 
998 8 mpu,'/TW_/' (v651*4|%|/), 
998 8 mpu,'|TW_|'(v100^a|%|/) 
998 8 mpu,'|TW_|'(v110^a|%|/) 
998 8 mpu,'|TW_|'(v245^a|%|/) 
998 8 mpu,'|TW_|'(v245^b|%|/) 
998 8 mpu,'|TW_|'(v600^a|%|/) 
998 8 mpu,'|TW_|'(v610^a|%|/) 
998 8 mpu,'|TW_|'(v700^a|%|/) 
998 8 mpu,'|TW_|'(v710^a|%|/) 
999 0 'N:',f(mfn,1,0) 