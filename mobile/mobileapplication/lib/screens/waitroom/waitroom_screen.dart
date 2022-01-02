import 'dart:async';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/scheduler.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/roomques/roomques_screen.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_bloc.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_event.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_state.dart';
import 'package:socket_io_client/socket_io_client.dart' as IO;

// Start connect to socket and insert user
// If have any error -> revert entercode_screen page
class WaitRoomScreen extends StatefulWidget {
  final String iduser;
  final String idroom;
  final String nameuser;

  const WaitRoomScreen({
    Key? key,
    required this.idroom,
    required this.iduser,
    required this.nameuser,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _WaitRoomScreenState();
}

class _WaitRoomScreenState extends State<WaitRoomScreen> {
  StreamSocket? _streamSocket;

  @override
  void initState() {
    super.initState();
    BlocProvider.of<WaitRoomBloc>(context).add(
      WaitRoomEventConnected(
        idroom: widget.idroom,
        iduser: widget.iduser,
        nameuser: widget.nameuser,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: const BoxDecoration(
        image: DecorationImage(
          image: AssetImage("assets/images/background-2.jpg"),
          fit: BoxFit.cover,
        ),
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        appBar: AppBar(
          backgroundColor: Colors.black.withOpacity(0.4),
          title: Text("Wait room ${widget.idroom}"),
        ),
        body: BlocConsumer<WaitRoomBloc, WaitRoomState>(
          listener: (context, state) {
            if (state is WaitRoomSuccess) {
              _streamSocket = state.streamSocket;
            }
          },
          builder: (context, state) {
            if (_streamSocket != null) {
              return StreamBuilder(
                stream: _streamSocket!.getResponse,
                builder: (context, snapshot) {
                  if (snapshot.hasData && snapshot.data == widget.idroom) {
                    // Navigate to roomques and start
                    Future.delayed(Duration.zero, () async {
                      _streamSocket!.dispose();
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(builder: (context) {
                          return RoomQuesScreen(
                            iduser: widget.iduser,
                            idroom: widget.idroom,
                          );
                        }),
                      );
                    });
                  }
                  if (snapshot.hasError) {
                    return Text(
                        'Some thing error ' + snapshot.error.toString());
                  }
                  return Container(
                    child: _WaitHostStartRoom(nameuser: widget.nameuser),
                  );
                },
              );
            }
            return Center(
              child: Column(
                children: [
                  Text(widget.iduser),
                  Text(widget.idroom),
                  Text(widget.nameuser),
                ],
              ),
            );
          },
        ),
      ),
    );
  }
}

class _WaitHostStartRoom extends StatelessWidget {
  final nameuser;

  const _WaitHostStartRoom({
    required this.nameuser,
  });

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
      width: size.width,
      child: Column(
        children: [
          Container(
            width: size.width,
            padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 15),
            margin: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: Colors.black.withOpacity(0.6),
              borderRadius: const BorderRadius.all(Radius.circular(10)),
            ),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  nameuser,
                  style: const TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                  ),
                ),
                CircleAvatar(
                  radius: 30,
                  backgroundColor: Colors.deepOrangeAccent,
                  child: ClipOval(
                    child: Image.asset(
                      'assets/images/img0.jpg',
                      fit: BoxFit.cover,
                      width: 100.0,
                      height: 100.0,
                    ),
                  ),
                ),
              ],
            ),
          ),
          Container(
            margin: const EdgeInsets.symmetric(vertical: 20),
            child: const Text(
              'Waiting for the host to start...',
              style: TextStyle(
                color: Colors.white,
                fontSize: 15,
              ),
            ),
          ),
        ],
      ),
    );
  }
}
