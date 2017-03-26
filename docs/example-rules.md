#Example rules

- If ram usage > 80% for more than 5 minutes, ram +1gb
- If systemload > x for more than y minutes,  cpu +1core
- If systemload > x for more than 2*y minutes, cpu -1 core
- If systemload > x for more than 2*y minutes, trigger alert (removing the last cpu is blocked by the isac api)
- If ram usage < x for more than y minutes, ram -1gb 
- If systemload < x for more than y minutes, cpu -1core
