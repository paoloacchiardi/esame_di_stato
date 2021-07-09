import requests as rq
import numpy as np
from random import randrange
import time
count_febbre = 0
count_metallo = 0
count_fumo = 0
inviaDati = "http://localhost/elaborato_prog/dati_sensori/riceviDatiSensori.php"
while(1):
    sensori = rq.get("http://localhost/elaborato_prog/api/sensori/getAllSensorsInEvents.php").json()
    areaMax = int(rq.get("http://localhost/elaborato_prog/api/eventi/getMaxAreaId.php").json()[0]['idMaxArea'])
    count_area = randrange(areaMax+1)
    print(f"Area: {count_area}")
    stop = float(np.random.uniform(0,2))
    time.sleep(stop)
    print(f"Stop: {stop}")
    for sensore in sensori:
        if(count_area == int(sensore['area'])):
            if sensore['nome'] == 'ip camera':
                temperatura = round(float(np.random.uniform(36,38)),2)
                if(temperatura > 37.5):
                    count_febbre += 1
                    if(count_febbre == 4):
                        #allarme
                        print(f"{sensore['nome']},{sensore['id']},{temperatura}")
                        esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":temperatura})
                        esito = None
                        count_febbre = 0
                    else:
                        temperatura = round(float(np.random.uniform(36,37)),2)
                        print(f"{sensore['nome']},{sensore['id']},{temperatura}")
                        esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":temperatura})
                        esito = None
                else:
                    print(f"{sensore['nome']},{sensore['id']},{temperatura}")
                    esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":temperatura})
                    esito = None
            elif sensore['nome'] == 'metal detector':
                metallo = randrange(2)
                if(metallo == 1):
                    count_metallo += 1
                    if(count_metallo == 8):
                        #allarme
                        count_metallo = 0
                        print(f"{sensore['nome']},{sensore['id']},{metallo}")
                        esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":metallo})
                        esito = None
                    else:
                        metallo = int(0)
                        print(f"{sensore['nome']},{sensore['id']},{metallo}")
                        esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":metallo})
                        esito = None
                else:
                    print(f"{sensore['nome']},{sensore['id']},{metallo}")
                    esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":metallo})
                    esito = None
            elif sensore['nome'] == 'smoke detector':
                fumo = randrange(651)
                if(fumo >= 600):
                    count_fumo += 1
                    if(count_fumo == 3):
                        #allarme
                        count_fumo = 0
                        print(f"{sensore['nome']},{sensore['id']},{fumo}")
                        esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":fumo})
                        esito = None
                    else:
                        fumo = randrange(600)
                        print(f"{sensore['nome']},{sensore['id']},{fumo}")
                        esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":fumo})
                        esito = None
                else:
                    print(f"{sensore['nome']},{sensore['id']},{fumo}")
                    esito = rq.get(inviaDati, params = {"idSensore":sensore["id"],"dato":fumo})
                    esito = None