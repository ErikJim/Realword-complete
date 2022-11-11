package io.zoooohs.realworld.domain.article.servie;

import org.springframework.amqp.core.AmqpTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Service;

@Service
public class RabbitMQProducerServiceImpl implements RabbitMQProducerService {

    @Value("${realworld.rabbitmq.exchange:exchange}")
    private String exchange;

    @Value("${realworld.rabbitmq.routingKey:key}")
    private String routingKey;

    @Autowired
    private AmqpTemplate rabbitTemplate;

    @Override
    public void send(String body) {
        System.out.println(body);
        rabbitTemplate.convertAndSend(exchange, routingKey, body);
    }
}
